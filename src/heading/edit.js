import colorScheme from "../inc/colorScheme"
import { useBlockProps, RichText, BlockControls, InspectorControls, ColorPalette } from "@wordpress/block-editor"
import { PanelBody, PanelRow, ToolbarGroup, ToolbarButton } from "@wordpress/components"
import "./editor.scss"

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps()

  const { color, size, text } = attributes

  const handleTextChange = (text) => {
    setAttributes({ text })
  }

  const handleColorChange = (value) => {
    const { name } = colorScheme.find((newColor) => newColor.color === value)
    setAttributes({ color: name })
  }

  return (
    <div {...blockProps}>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton title="Large" onClick={() => setAttributes({ size: "large" })} isPressed={size === "large"}>
            Large
          </ToolbarButton>
          <ToolbarButton title="Medium" onClick={() => setAttributes({ size: "medium" })} isPressed={size === "medium"}>
            Medium
          </ToolbarButton>
          <ToolbarButton title="Small" onClick={() => setAttributes({ size: "small" })} isPressed={size === "small"}>
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
      <RichText allowedFormats={["core/bold", "core/italic"]} tagName="h1" className={`headline headline--${size} headline--${color}`} value={text} onChange={handleTextChange} />
    </div>
  )
}
