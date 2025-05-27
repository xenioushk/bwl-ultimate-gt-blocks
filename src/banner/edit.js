import apiFetch from "@wordpress/api-fetch"
import { useBlockProps, InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck } from "@wordpress/block-editor"
import { Button, PanelBody, PanelRow } from "@wordpress/components"
import { useEffect } from "@wordpress/element"
import "./editor.scss"

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps()
  function onFileSelect(x) {
    setAttributes({ imgID: x.id })
  }

  useEffect(
    function () {
      async function go() {
        const response = await apiFetch({
          path: `/wp/v2/media/${attributes.imgID}`,
          method: "GET",
        })
        setAttributes({ imgURL: response.media_details.sizes.full.source_url })
      }
      go()
    },
    [attributes.imgID]
  )

  return (
    <>
      <InspectorControls>
        <PanelBody title="Background" initialOpen={true}>
          <PanelRow>
            <MediaUploadCheck>
              <MediaUpload
                onSelect={onFileSelect}
                value={attributes.imgID}
                render={({ open }) => {
                  return <Button onClick={open}>Choose Image</Button>
                }}
              />
            </MediaUploadCheck>
          </PanelRow>
        </PanelBody>
      </InspectorControls>
      <div {...blockProps} style={{ backgroundImage: `url('${attributes.imgURL}')` }}>
        <InnerBlocks allowedBlocks={["bugtb/heading", "bugtb/button"]} />
      </div>
    </>
  )
}
