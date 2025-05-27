import { __ } from "@wordpress/i18n"
import { RawHTML, useState } from "@wordpress/element"
import { format, dateI18n, __experimentalGetSettings } from "@wordpress/date"
import { useBlockProps, InspectorControls } from "@wordpress/block-editor"
import { PanelBody, ToggleControl, QueryControls, Spinner } from "@wordpress/components"
import { useSelect } from "@wordpress/data"
import "./editor.scss"

export default function Edit({ attributes, setAttributes }) {
  const { numberOfPosts, displayFeaturedImage, order, orderBy, categories } = attributes
  const catIDs = categories && categories.length > 0 ? categories.map((cat) => cat.id) : []
  const posts = useSelect(
    (select) => {
      return select("core").getEntityRecords("postType", "petitions", {
        per_page: numberOfPosts,
        _embed: true,
        order,
        orderby: orderBy,
        petitions_category: catIDs,
      })
    },
    [numberOfPosts, order, orderBy, categories]
  )

  const allCats = useSelect((select) => {
    return select("core").getEntityRecords("taxonomy", "petitions_category", {
      per_page: -1,
    })
  }, [])

  const catSuggestions = {}
  if (allCats) {
    for (let i = 0; i < allCats.length; i++) {
      const cat = allCats[i]
      catSuggestions[cat.name] = cat
    }
  }

  const onDisplayFeaturedImageChange = (value) => {
    setAttributes({ displayFeaturedImage: value })
  }
  const onNumberOfItemsChange = (value) => {
    setAttributes({ numberOfPosts: value })
  }

  const onCategoryChange = (values) => {
    const hasNoSuggestions = values.some((value) => typeof value === "string" && !catSuggestions[value])
    if (hasNoSuggestions) return

    const updatedCats = values.map((token) => {
      return typeof token === "string" ? catSuggestions[token] : token
    })

    setAttributes({ categories: updatedCats })
  }

  return (
    <div {...useBlockProps()}>
      <InspectorControls>
        <PanelBody>
          <ToggleControl label={__("Display Featured Image", "latest-posts")} checked={displayFeaturedImage} onChange={onDisplayFeaturedImageChange} />
          <QueryControls numberOfItems={numberOfPosts || -1} onNumberOfItemsChange={onNumberOfItemsChange} maxItems={10} minItems={1} orderBy={orderBy} onOrderByChange={(value) => setAttributes({ orderBy: value })} order={order} onOrderChange={(value) => setAttributes({ order: value })} categorySuggestions={catSuggestions} selectedCategories={categories} onCategoryChange={onCategoryChange} />
        </PanelBody>
      </InspectorControls>
      <ul>
        {posts &&
          posts.map((post) => {
            const featuredImage = post._embedded && post._embedded["wp:featuredmedia"] && post._embedded["wp:featuredmedia"].length > 0 && post._embedded["wp:featuredmedia"][0]
            // console.log(featuredImage)
            // const signCount = post.meta?.sign_count ?? 0
            return (
              <li key={post.id}>
                {displayFeaturedImage && featuredImage && <img src={featuredImage.media_details.sizes.thumbnail.source_url} alt={featuredImage.alt_text} />}
                <h5>
                  <a href={post.link}>{post.title.rendered ? <RawHTML>{post.title.rendered}</RawHTML> : __("(No title)", "latest-posts")}</a>
                </h5>
                {post.date && <time dateTime={format("c", post.date)}>{dateI18n(__experimentalGetSettings().formats.date, post.date)}</time>}
              </li>
            )
          })}
      </ul>
    </div>
  )
}
