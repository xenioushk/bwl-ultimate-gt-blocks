import { useBlockProps } from '@wordpress/block-editor';
import { useState } from '@wordpress/element';
import {
	RichText,
	InspectorControls,
	BlockControls,
} from '@wordpress/block-editor';
import {
	ToolbarGroup,
	ToolbarButton,
	Button,
	PanelBody,
	PanelRow,
	ColorPalette,
} from '@wordpress/components';

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
					allowedFormat={['core/bold']}
					tagName="a"
					value={attributes.text}
					onChange={(value) => setAttributes({ text: value })}
				></RichText>
			</div>
		</>
	);
}
