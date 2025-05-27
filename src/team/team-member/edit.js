import wpDashIcon from '../../inc/wpDashIcon';
import {
	useBlockProps,
	RichText,
	MediaPlaceholder,
	BlockControls,
	MediaReplaceFlow,
	InspectorControls,
	store as BlockEditorStore,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import {
	Spinner,
	withNotices,
	ToolbarButton,
	ExternalLink,
	PanelBody,
	TextareaControl,
	SelectControl,
	Icon,
	Tooltip,
	TextControl,
	Button,
	ColorPicker,
	Notice,
} from '@wordpress/components';
import { isBlobURL, revokeBlobURL } from '@wordpress/blob';
import { useState, useEffect, useRef } from '@wordpress/element';
import { useSelect } from '@wordpress/data';
import { usePrevious } from '@wordpress/compose';

function Edit({
	attributes,
	setAttributes,
	noticeUI,
	noticeOperations,
	isSelected,
}) {
	const { name, bio, url, alt, id, socialLinks } = attributes;
	const [blobUrl, setBlobUrl] = useState();
	const [selectedLink, setSelectedLink] = useState();

	const previousUrl = usePrevious(url);
	const previousIsSelected = usePrevious(isSelected);
	const titleRef = useRef();

	const imageObject = useSelect(
		(select) => {
			const { getMedia } = select('core');
			return id ? getMedia(id) : null;
		},
		[id]
	);

	// console.log(imageObject);

	const imageSizes = useSelect((select) => {
		return select(BlockEditorStore).getSettings().imageSizes;
	}, []);
	// console.log(imageSizes);

	const getImageSizeOptions = () => {
		if (!imageObject) return [];
		const options = [];
		const sizes = imageObject.media_details.sizes;
		for (const key in sizes) {
			const size = sizes[key];
			const imageSize = imageSizes.find((s) => s.slug === key);

			if (imageSize) {
				options.push({
					label: imageSize.name,
					value: size.source_url,
				});
			}
		}
		return options;
	};

	const onChangeName = (newName) => {
		setAttributes({ name: newName });
	};

	const onChangeBio = (newBio) => {
		setAttributes({ bio: newBio });
	};

	const onChangeImageSize = (newUrl) => {
		setAttributes({ url: newUrl });
	};

	const onSelectImage = (image) => {
		// If there is no image.
		if (!image || !image.url) {
			setAttributes({ id: undefined, alt: '', url: undefined });
			return;
		}

		// If images uploaded successfully.
		setAttributes({
			id: image.id,
			alt: image.alt,
			url: image.url,
		});
	};

	const onSelectUrl = (image) => {
		setAttributes({
			url: image,
			id: undefined,
			alt: '',
		});
	};

	const onUploadError = (error) => {
		noticeOperations.removeAllNotices();
		noticeOperations.createErrorNotice(error);
	};

	const removeImage = () => {
		setAttributes({
			id: undefined,
			alt: '',
			url: undefined,
		});
	};

	const addNewSocialLink = () => {
		setAttributes({
			socialLinks: [
				...socialLinks,
				{
					link: '',
					icon: 'wordpress',
				},
			],
		});

		setSelectedLink(socialLinks.length);
	};

	const onChangeAltText = (newAltText) => {
		setAttributes({
			alt: newAltText,
		});
	};

	// Run use Effect at the beginning

	useEffect(() => {
		if (!id && !isBlobURL(url)) {
			setAttributes({
				id: undefined,
				alt: '',
			});
		}
	}, []);

	// When the URL changed we need to free the memory.

	useEffect(() => {
		if (isBlobURL(url)) {
			setBlobUrl(url);
		} else {
			revokeBlobURL(blobUrl);
		}
	}, [url]);

	//

	useEffect(() => {
		if (url && !previousUrl && isSelected) {
			titleRef.current.focus();
		}
	}, [url, previousUrl]);

	// Remove the border of icon.
	useEffect(() => {
		if (previousIsSelected && !isSelected) {
			setSelectedLink();
		}
	}, [isSelected, previousIsSelected]);

	const UpdateSocialIcon = (type, value) => {
		const socialLinksCopy = [...socialLinks];
		socialLinksCopy[selectedLink][type] = value;
		setAttributes({
			socialLinks: socialLinksCopy,
		});
	};

	const removeSocialIcon = () => {
		if (socialLinks.length) {
			setAttributes({
				socialLinks: [
					...socialLinks.slice(0, selectedLink),
					...socialLinks.slice(selectedLink + 1),
				],
			});
			setSelectedLink();
		}
	};

	return (
		<>
			{url && !isBlobURL(url) && (
				<InspectorControls>
					<PanelBody>
						<TextareaControl
							label={__('Alt Text', 'team-member')}
							value={alt}
							onChange={onChangeAltText}
							help={__('Some help text', 'team-member')}
						/>
						{id && (
							<SelectControl
								label={__('Image Sizes', 'team-member')}
								options={getImageSizeOptions()}
								value={url}
								onChange={onChangeImageSize}
							/>
						)}
					</PanelBody>
				</InspectorControls>
			)}

			{url && (
				<BlockControls group="inline">
					<MediaReplaceFlow
						name={__('Replace Image', 'team-member')}
						onSelect={onSelectImage}
						onSelectURL={onSelectUrl}
						onError={onUploadError}
						accept="image/*"
						allowedTypes={['image']}
						mediaId={id}
						mediaUrl={url}
					/>
					<ToolbarButton onClick={removeImage}>
						{__('Remove Image', 'team-member')}
					</ToolbarButton>
				</BlockControls>
			)}

			<div {...useBlockProps()}>
				{url && (
					<div
						className={`wp-block-bwl-ultimate-gt-blocks-team-member-img${
							isBlobURL(url) ? ' is-loading' : ''
						}`}
					>
						<img src={url} alt={alt} />
						{isBlobURL(url) && <Spinner />}
					</div>
				)}
				<MediaPlaceholder
					icon="admin-users"
					onSelect={onSelectImage}
					onSelectURL={onSelectUrl}
					onError={onUploadError}
					accept="image/*"
					allowedTypes={['image']}
					disableMediaButtons={url}
					notices={noticeUI}
				/>
				<RichText
					ref={titleRef}
					placeholder={__('Member name', 'team-member')}
					tagName="h4"
					value={name}
					onChange={onChangeName}
					allowedFormats={[]}
				/>
				<RichText
					placeholder={__('Bio', 'team-member')}
					tagName="p"
					value={bio}
					onChange={onChangeBio}
					allowedFormats={[]}
				/>
				<wpDashIcon />
				<div className="wp-block-bwl-ultimate-gt-blocks-team-member-social-links">
					<ul>
						{socialLinks.map((item, index) => {
							return (
								<li
									key={index}
									className={
										selectedLink === index
											? 'is-selected'
											: null
									}
								>
									<button
										aria-label={__(
											'Edit social link',
											'team-member'
										)}
										onClick={() => setSelectedLink(index)}
									>
										<Icon icon={item.icon} />
									</button>
								</li>
							);
						})}

						{isSelected && (
							<li className="wp-block-bwl-ultimate-gt-blocks-team-member-add-icon">
								<Tooltip
									text={__('Add social link', 'team-member')}
								>
									<button
										aria-label={__(
											'Add social link',
											'team-member'
										)}
										onClick={addNewSocialLink}
									>
										<Icon icon="plus" />
									</button>
								</Tooltip>
							</li>
						)}
					</ul>
				</div>

				{selectedLink !== undefined && (
					<div className="wp-block-bwl-ultimate-gt-blocks-team-member-link-form">
						<TextControl
							label={__('Icon', 'team-member')}
							value={socialLinks[selectedLink].icon}
							onChange={(value) =>
								UpdateSocialIcon('icon', value)
							}
						/>
						<TextControl
							label={__('Link', 'team-member')}
							value={socialLinks[selectedLink].link}
							onChange={(value) =>
								UpdateSocialIcon('link', value)
							}
						/>
						<Button isDestructive onClick={removeSocialIcon}>
							{__('Remove Link', 'team-member')}
						</Button>
					</div>
				)}
			</div>
		</>
	);
}

export default withNotices(Edit);
