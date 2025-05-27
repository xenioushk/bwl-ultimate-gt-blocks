import colorScheme from "../inc/colorScheme"
import { useBlockProps, RichText, BlockControls, InspectorControls, ColorPalette } from "@wordpress/block-editor"
import { PanelBody, PanelRow, ToolbarGroup, ToolbarButton } from "@wordpress/components"
import "./editor.scss"

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps()
  const { text, size, color } = attributes

  const handleColorChange = (value) => {
    const { name } = colorScheme.find((newColor) => newColor.color === value)
    setAttributes({ color: name })
  }
  return (
    <div {...blockProps}>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton isPressed={size === "large"} onClick={() => setAttributes({ size: "large" })}>
            Large
          </ToolbarButton>
          <ToolbarButton isPressed={size === "medium"} onClick={() => setAttributes({ size: "medium" })}>
            Medium
          </ToolbarButton>
          <ToolbarButton isPressed={size === "small"} onClick={() => setAttributes({ size: "small" })}>
            Small
          </ToolbarButton>
        </ToolbarGroup>
      </BlockControls>
      <InspectorControls>
        <PanelBody title="Color" initialOpen={true}>
          <PanelRow>
            <ColorPalette colors={colorScheme} value={color} onChange={handleColorChange} disableCustomColors={true} clearable={false} />
          </PanelRow>
        </PanelBody>
      </InspectorControls>

      <RichText allowedFormats={["core/bold", "core/italic", "core/link"]} tagName="a" value={text} onChange={(value) => setAttributes({ text: value || "" })} className={`btn btn--${size} btn--${color}`} />
    </div>
  )
}
