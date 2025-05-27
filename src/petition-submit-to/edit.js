import { __ } from "@wordpress/i18n"
import { useBlockProps, InspectorControls } from "@wordpress/block-editor"
import { PanelBody, PanelRow } from "@wordpress/components"
import { useSelect } from "@wordpress/data"
import { useState, useEffect, RawHTML } from "@wordpress/element"
import apiFetch from "@wordpress/api-fetch"
import "./editor.scss"

export default function Edit({ attributes, setAttributes }) {
  const { petitionId, type } = attributes
  const [petitionsPreview, setPetitionsPreview] = useState("")

  useEffect(() => {
    async function fetchData() {
      const response = await apiFetch({
        path: `bptm/v1/petitions?petitionId=${petitionId}&type=${type}`,
        method: "GET",
      })
      setPetitionsPreview(response)
    }

    fetchData()
  }, [petitionId])

  const handlePetitionSelection = (petitionId) => {
    setAttributes({ petitionId: petitionId.target.value })
  }

  // Get all the poll.

  const petitions = useSelect((select) => {
    return select("core").getEntityRecords("postType", "petitions", {
      per_page: -1,
    })
  }, [])

  return (
    <div
      {...useBlockProps({
        className: "bpm-gt-editor-container",
      })}
    >
      <InspectorControls>
        <PanelBody title="Petitions" initialOpen={true}>
          <PanelRow>
            <select onChange={handlePetitionSelection}>
              <option value="">Select A Petition</option>
              {petitions &&
                petitions.map((petition) => {
                  return (
                    <option value={petition.id} selected={petitionId == petition.id}>
                      <RawHTML>{petition.title.rendered}</RawHTML>
                    </option>
                  )
                })}
            </select>
          </PanelRow>
        </PanelBody>
      </InspectorControls>
      {petitionId && (
        <div className="bpm-gt-editor-preview">
          <p>
            <strong>Petition ID:</strong> {petitionId}
          </p>
          <RawHTML>{petitionsPreview}</RawHTML>
        </div>
      )}
    </div>
  )
}
