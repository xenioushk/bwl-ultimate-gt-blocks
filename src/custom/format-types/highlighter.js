import { registerFormatType, toggleFormat } from "@wordpress/rich-text"
import { RichTextToolbarButton } from "@wordpress/block-editor"
import { __ } from "@wordpress/i18n"
registerFormatType("bwl-ultimate-gt-blocks/highlighter", {
  title: __("Steps Highlighter", "bwl-ultimate-gt-blocks"),
  tagName: "span",
  className: "bwl-steps-highlighter",
  edit({ isActive, value, onChange }) {
    return (
      <RichTextToolbarButton
        icon="edit"
        title={__("Steps Highlighter", "bwl-ultimate-gt-blocks")}
        onClick={() => {
          onChange(
            toggleFormat(value, {
              type: "bwl-ultimate-gt-blocks/highlighter",
            })
          )
        }}
        isActive={isActive}
      />
    )
  },
  // attributes: {
  //   style: {
  //     type: "string",
  //     default: "background-color: yellow; color: black;",
  //   },
  // },
  // transforms: {
  //   from: [
  //     {
  //       type: "class",
  //       name: "bwl-ultimate-gt-blocks-highlighter",
  //       isMatch: (el) => el.classList.contains("bwl-ultimate-gt-blocks-highlighter"),
  //       transform: (el) => {
  //         el.classList.remove("bwl-ultimate-gt-blocks-highlighter")
  //         return {
  //           type: "bwl-ultimate-gt-blocks/highlighter",
  //           attributes: { style: "background-color: yellow; color: black;" },
  //         }
  //       },
  //     },
  //   ],
  // },
  // save: () => {
  //   // The save function is not needed for formats
  //   return null
  // },
})
// This format type allows users to highlight text in the editor
// by applying a yellow background color and black text color.
// It can be toggled on and off using the Rich Text Toolbar Button.
// The format is registered with the name "bwl-ultimate-gt-blocks/highlighter"
// and can be applied to text elements in the block editor.
