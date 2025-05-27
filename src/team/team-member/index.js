import { registerBlockType } from "@wordpress/blocks"
import { __ } from "@wordpress/i18n"
import Edit from "./edit"
import Save from "./save"

registerBlockType("bugtb/team-member", {
  title: __("Team member", "bugtb"),
  description: __("Single team member block", "bugtb"),
  icon: "admin-users",
  parent: ["bugtb/team"],
  supports: {
    html: false,
    reusable: false,
  },
  attributes: {
    name: {
      type: "string",
      source: "html",
      selector: "h4",
    },
    bio: {
      type: "string",
      source: "html",
      selector: "p",
    },
    id: {
      type: "number",
    },
    alt: {
      type: "string",
      source: "attribute",
      attribute: "alt",
      selector: "img",
      default: "",
    },
    url: {
      type: "string",
      source: "attribute",
      attribute: "src",
      selector: "img",
    },
    socialLinks: {
      type: "array",
      default: [
        { link: "http://f.com", icon: "facebook" },
        { link: "http://t.com", icon: "twitter" },
      ],
      source: "query",
      selector: ".wp-block-bugtb-team-member-social-links ul li",
      query: {
        icon: {
          source: "attribute",
          attribute: "data-icon",
        },
        link: {
          source: "attribute",
          selector: "a",
          attribute: "href",
        },
      },
    },
  },
  edit: Edit,
  save: Save,
})
