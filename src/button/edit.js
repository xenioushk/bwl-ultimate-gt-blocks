import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	BlockControls,
} from '@wordpress/block-editor';
import { ToolbarGroup, ToolbarButton } from '@wordpress/components';
export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();

	return (
		<>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarButton
						isPressed={attributes.size === 'large'}
						onClick={() => setAttributes({ size: 'large' })}
					>
						Large
					</ToolbarButton>
					<ToolbarButton
						isPressed={attributes.size === 'medium'}
						onClick={() => setAttributes({ size: 'medium' })}
					>
						Medium
					</ToolbarButton>
					<ToolbarButton
						isPressed={attributes.size === 'small'}
						onClick={() => setAttributes({ size: 'small' })}
					>
						Small
					</ToolbarButton>
				</ToolbarGroup>
			</BlockControls>
			<div {...blockProps}>
				<RichText
					tagName="a"
					allowedFormat={[]}
					value={attributes.text}
					onChange={(value) => setAttributes({ text: value || '' })}
					placeholder={__('Button text', 'bwl-ultimate-gt-blocks')}
				></RichText>
			</div>
		</>
	);
}
