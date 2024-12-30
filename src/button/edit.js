import {
	useBlockProps,
	RichText,
	BlockControls,
	InspectorControls,
	ColorPalette,
} from '@wordpress/block-editor';
import {
	PanelBody,
	PanelRow,
	ToolbarGroup,
	ToolbarButton,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	const { text, size, color } = attributes;

	const ourColors = [
		{
			name: 'red',
			color: '#f00',
		},
		{ name: 'green', color: '#0f0' },
		{ name: 'blue', color: '#00f' },
	];

	const handleColorChange = (value) => {
		setAttributes({ color: value });
	};
	return (
		<>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarButton
						isPressed={size === 'large'}
						onClick={() => setAttributes({ size: 'large' })}
					>
						Large
					</ToolbarButton>
					<ToolbarButton
						isPressed={size === 'medium'}
						onClick={() => setAttributes({ size: 'medium' })}
					>
						Medium
					</ToolbarButton>
					<ToolbarButton
						isPressed={size === 'small'}
						onClick={() => setAttributes({ size: 'small' })}
					>
						Small
					</ToolbarButton>
				</ToolbarGroup>
			</BlockControls>
			<InspectorControls>
				<PanelBody title="Color" initialOpen={true}>
					<PanelRow>
						<ColorPalette
							colors={ourColors}
							value={color}
							onChange={handleColorChange}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<RichText
					allowedFormats={['core/bold', 'core/italic', 'core/link']}
					tagName="a"
					value={text}
					onChange={(value) => setAttributes({ text: value || '' })}
				></RichText>
			</div>
		</>
	);
}
