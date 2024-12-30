import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import './filter';
import Edit from './edit';
import metadata from './block.json';
registerBlockType(metadata.name, {
	edit: Edit,
});
