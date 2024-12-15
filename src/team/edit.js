import { __ } from '@wordpress/i18n';

import {
	useBlockProps,
	InnerBlocks,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const teamMemberTemplates = [
		['bwl-ultimate-gt-blocks/team-member'],
		['bwl-ultimate-gt-blocks/team-member'],
		['bwl-ultimate-gt-blocks/team-member'],
	];

	const { columns } = attributes;

	const onChangeColumn = (newColumns) => {
		setAttributes({ columns: newColumns });
	};

	return (
		<div
			{...useBlockProps({
				className: `has-${columns}-columns`,
			})}
		>
			<InspectorControls>
				<PanelBody>
					<RangeControl
						label={__('Columns', 'bwl-ultimate-gt-blocks')}
						min={1}
						max={6}
						value={columns}
						onChange={onChangeColumn}
					/>
				</PanelBody>
			</InspectorControls>
			<InnerBlocks
				template={teamMemberTemplates}
				allowedBlocks={['bwl-ultimate-gt-blocks/team-member']}
				orientation="horizontal"
			/>
		</div>
	);
}
