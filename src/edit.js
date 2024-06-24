import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { useSelect } from "@wordpress/data";
import { RawHTML } from "@wordpress/element";
import { PanelBody, QueryControls, ToggleControl } from "@wordpress/components";
import { format, dateI18n, getSettings } from "@wordpress/date";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const {
		numberOfPosts,
		displayFeaturedImage,
		displayExcerpt,
		order,
		orderBy,
		categories,
	} = attributes;

	const catIds =
		categories && categories.length > 0 ? categories.map((cat) => cat.id) : [];

	const posts = useSelect(
		(select) => {
			return select("core").getEntityRecords("postType", "post", {
				per_page: numberOfPosts,
				_embed: true, // required for query the feature image.
				order: order, // ASC or DESC
				orderBy: orderBy, // Title, Date
				categories: catIds,
			});
		},
		[numberOfPosts, order, orderBy, categories],
	);

	const allCats = useSelect((select) => {
		return select("core").getEntityRecords("taxonomy", "category", {
			per_page: -1,
		});
	}, []);

	const categorySuggestions = {};

	if (allCats) {
		for (let i = 0; i < allCats.length; i++) {
			const cat = allCats[i];
			categorySuggestions[cat.name] = cat;
		}
	}
	// console.log(categories);

	const handleDisplayFeaturedImage = (status) => {
		setAttributes({ displayFeaturedImage: status });
	};

	const handleDisplayExcerpt = (status) => {
		setAttributes({ displayExcerpt: status });
	};

	const handleNumberOfItemsChange = (postsCount) => {
		setAttributes({ numberOfPosts: postsCount });
	};

	const handleCategoriesChange = (values) => {
		const hasNoSuggestions = values.some(
			(value) => typeof value === "string" && !categorySuggestions[value],
		);
		if (hasNoSuggestions) return;

		const updatedCats = values.map((token) => {
			return typeof token === "string" ? categorySuggestions[token] : token;
		});

		setAttributes({ categories: updatedCats });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody>
					<ToggleControl
						label="Display featured image?"
						checked={displayFeaturedImage}
						onChange={handleDisplayFeaturedImage}
					/>
					<ToggleControl
						label="Display post excerpt?"
						checked={displayExcerpt}
						onChange={handleDisplayExcerpt}
					/>
					<QueryControls
						numberOfItems={numberOfPosts}
						onNumberOfItemsChange={handleNumberOfItemsChange}
						minItems={1}
						maxItems={10}
						orderBy={orderBy}
						onOrderByChange={(value) => setAttributes({ orderBy: value })}
						order={order}
						onOrderChange={(value) => setAttributes({ order: value })}
						categorySuggestions={categorySuggestions}
						selectedCategories={categories}
						onCategoryChange={handleCategoriesChange}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				{posts &&
					posts.map((post) => {
						const featuredMedia =
							post._embedded &&
							post._embedded["wp:featuredmedia"] &&
							post._embedded["wp:featuredmedia"].length > 0 &&
							post._embedded["wp:featuredmedia"][0];
						return (
							<div key={post.id}>
								{post.title && (
									<h2>
										<a href={post.link}>
											<RawHTML>{post.title.rendered}</RawHTML>
										</a>
									</h2>
								)}

								{post.excerpt && displayExcerpt && (
									<div>
										<RawHTML>{post.excerpt.rendered}</RawHTML>
									</div>
								)}

								{displayFeaturedImage && featuredMedia && (
									<div>
										<img
											src={featuredMedia.media_details.sizes.medium.source_url}
											alt={featuredMedia.alt_text}
										/>
									</div>
								)}

								{post.date_gmt && (
									<time dateTime={format("c", post, post.date_gmt)}>
										{dateI18n(getSettings().formats.date, post.date_gmt)}
									</time>
								)}
							</div>
						);
					})}
			</div>
		</>
	);
}
