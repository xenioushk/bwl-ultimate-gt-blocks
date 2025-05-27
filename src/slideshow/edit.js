import { useBlockProps, InnerBlocks } from "@wordpress/block-editor"
import "./editor.scss"
import { useEffect, useRef } from "@wordpress/element"
import Swiper from "swiper"

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps()
  const sliderRef = useRef()

  useEffect(() => {
    console.log(sliderRef.current)
    if (sliderRef.current) {
      new Swiper(sliderRef.current, {
        slidesPerView: 1,
        navigation: true,
        pagination: { clickable: true, el: ".swiper-pagination" },
      })
    }
  }, [])

  const TEMPLATE = [["bugtb/slide"], ["bugtb/slide"]]

  return (
    <>
      <div {...blockProps} className="swiper-container" ref={sliderRef}>
        <div className="swiper-wrapper">
          <InnerBlocks allowedBlocks={["bugtb/slide", "bugtb/button"]} template={TEMPLATE} />
        </div>
        <div className="swiper-pagination"></div>
      </div>
    </>
  )
}
