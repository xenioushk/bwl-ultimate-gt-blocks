import { RichText, useBlockProps } from "@wordpress/block-editor"
import "./editor.scss"

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps()
  const { content } = attributes

  function handleSlideContent(content) {
    setAttributes({ content })
  }

  return (
    <>
      <div {...blockProps} className="slide">
        <RichText tagName="p" value={content} onChange={handleSlideContent} placeholder="Enter slide content..." />
      </div>
    </>
  )
}
