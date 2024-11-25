// import { __ } from '@wordpress/i18n';
import { useState, RawHTML } from '@wordpress/element';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import {
	PanelBody,
	QueryControls,
	ToggleControl,
	SelectControl,
} from '@wordpress/components';
import { format, dateI18n, getSettings } from '@wordpress/date';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const {
		numberOfPosts,
		displayFeaturedImage,
		displayExcerpt,
		order,
		orderBy,
		categories,
		tags,
	} = attributes;

	const [ size, setSize ] = useState( '50%' );

	const catIds =
		categories && categories.length > 0
			? categories.map( ( cat ) => cat.id )
			: [];

	const tagsId = tags && tags.length > 0 ? tags.map( ( tag ) => tag.id ) : [];

	const posts = useSelect(
		( select ) => {
			return select( 'core' ).getEntityRecords( 'postType', 'post', {
				per_page: numberOfPosts,
				_embed: true, // required for query the feature image.
				order, // ASC or DESC
				orderBy, // Title, Date
				categories: catIds,
				post_tag: tagsId,
			} );
		},
		[ numberOfPosts, order, orderBy, categories, tags ]
	);

	// Get all the categories.
	const allCats = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'taxonomy', 'category', {
			per_page: -1,
		} );
	}, [] );

	const categorySuggestions = {};

	if ( allCats ) {
		for ( let i = 0; i < allCats.length; i++ ) {
			const cat = allCats[ i ];
			categorySuggestions[ cat.name ] = cat;
		}
	}
	// console.log( categories );

	// Get all the tags.
	const allTags = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'taxonomy', 'post_tag', {
			per_page: -1,
		} );
	}, [] );

	const tagSuggestions = {};
	if ( allTags ) {
		for ( let i = 0; i < allTags.length; i++ ) {
			const tag = allTags[ i ];
			tagSuggestions[ tag.name ] = tag;
		}
	}
	// console.log( tagSuggestions );
	// console.log( tagSuggestions );

	const handleDisplayFeaturedImage = ( status ) => {
		setAttributes( { displayFeaturedImage: status } );
	};

	const handleDisplayExcerpt = ( status ) => {
		setAttributes( { displayExcerpt: status } );
	};

	const handleNumberOfItemsChange = ( postsCount ) => {
		setAttributes( { numberOfPosts: postsCount } );
	};

	const handleCategoriesChange = ( values ) => {
		const hasNoSuggestions = values.some(
			( value ) =>
				typeof value === 'string' && ! categorySuggestions[ value ]
		);
		if ( hasNoSuggestions ) return;

		const updatedCats = values.map( ( token ) => {
			return typeof token === 'string'
				? categorySuggestions[ token ]
				: token;
		} );

		setAttributes( { categories: updatedCats } );
	};

	const handleTagsChange = ( values ) => {
		const hasNoSuggestions = values.some(
			( value ) => typeof value === 'string' && tagSuggestions[ value ]
		);
		if ( hasNoSuggestions ) return;

		const updatedTags = values.map( ( token ) => {
			return typeof token === 'string' ? tagSuggestions[ token ] : token;
		} );
		setAttributes( { tags: updatedTags } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody>
					<SelectControl
						multiple
						label="Size"
						value={ size }
						options={ [
							{ label: 'Big', value: '100%' },
							{ label: 'Medium', value: '50%' },
							{ label: 'Small', value: '25%' },
						] }
						onChange={ ( newSize ) => setSize( newSize ) }
					/>
					<ToggleControl
						label="Display featured image?"
						checked={ displayFeaturedImage }
						onChange={ handleDisplayFeaturedImage }
					/>
					<SelectControl
						label="Tags"
						value={ tags }
						options={ tagSuggestions }
						onChange={ handleTagsChange }
					/>
					<ToggleControl
						label="Display post excerpt?"
						checked={ displayExcerpt }
						onChange={ handleDisplayExcerpt }
					/>
					<QueryControls
						numberOfItems={ numberOfPosts }
						onNumberOfItemsChange={ handleNumberOfItemsChange }
						minItems={ 1 }
						maxItems={ 10 }
						orderBy={ orderBy }
						onOrderByChange={ ( value ) =>
							setAttributes( { orderBy: value } )
						}
						order={ order }
						onOrderChange={ ( value ) =>
							setAttributes( { order: value } )
						}
						categorySuggestions={ categorySuggestions }
						selectedCategories={ categories }
						onCategoryChange={ handleCategoriesChange }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
				{ posts &&
					posts.map( ( post ) => {
						const featuredMedia =
							post._embedded &&
							post._embedded[ 'wp:featuredmedia' ] &&
							post._embedded[ 'wp:featuredmedia' ].length > 0 &&
							post._embedded[ 'wp:featuredmedia' ][ 0 ];
						return (
							<div className="blog-post" key={ post.id }>
								{ post.title && (
									<h2>
										<a href={ post.link }>
											<RawHTML>
												{ post.title.rendered }
											</RawHTML>
										</a>
									</h2>
								) }

								{ post.excerpt && displayExcerpt && (
									<div>
										<RawHTML>
											{ post.excerpt.rendered }
										</RawHTML>
									</div>
								) }

								{ displayFeaturedImage && featuredMedia && (
									<div>
										<img
											src={
												featuredMedia.media_details
													.sizes.medium.source_url
											}
											alt={ featuredMedia.alt_text }
										/>
									</div>
								) }

								{ post.date_gmt && (
									<time
										dateTime={ format(
											'c',
											post,
											post.date_gmt
										) }
									>
										{ dateI18n(
											getSettings().formats.date,
											post.date_gmt
										) }
									</time>
								) }
							</div>
						);
					} ) }
			</div>
		</>
	);
}
