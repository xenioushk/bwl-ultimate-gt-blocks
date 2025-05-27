import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';
const changeButtonBlock = (settings, name) => {
	if (name !== 'core/buttons') {
		return settings;
	}

	return {
		...settings,
		// icon: 'twitter',
	};
};

addFilter(
	'blocks.registerBlockType',
	'bwl-ultimate-gt/change-button-block',
	changeButtonBlock
);

// Add Editor Feature.

const modfiyButtonBlock = (BlockEdit) => {
	return (props) => {
		const { name, size } = props;

		if (name !== 'core/button') {
			return (
				<>
					<BlockEdit {...props} />
				</>
			);
		}

		return (
			<>
				<BlockEdit {...props} />
				<InspectorControls>
					<PanelBody>
						<RangeControl
							label="Size"
							value={size}
							onChange={(value) => {
								props.setAttributes({ size: value });
							}}
							min={1}
							max={100}
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
};

addFilter(
	'editor.BlockEdit',
	'bwl-ultimate-gt/change-button-block',
	modfiyButtonBlock
);
