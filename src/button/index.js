import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
// import save from './save';
import metadata from './block.json';

function save() {
	return '<div>Button frontend</div>';
}

registerBlockType( metadata.name, {
	edit: Edit,
	save,
} );
