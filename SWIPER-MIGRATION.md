# Swiper Migration Guide

## Overview
All Swiper implementations have been consolidated into a unified, data-attribute-based system. This eliminates the need for multiple CSS classes and reduces code duplication.

## What Changed

### Before (Deprecated)
Multiple class variants with hardcoded configurations:
- `.wit-swiper-card` - Standard card swiper
- `.wit-swiper-card_x` - Extra columns variant
- `.wit-swiper-card_date` - Date card variant
- `.wit-swiper-card_col4` - 4-column layout variant
- `.wit-swiper-gallery` - Gallery swiper
- `.wit-swiper-vdo` - Video swiper

### After (Current)
Single `.wit-swiper` class with configurable data attributes:
- `data-slides` - Number of slides per view
- `data-space` - Space between slides (px)
- `data-breakpoints` - JSON object for responsive breakpoints
- `data-nested` - Enable nested mode ("true"/"false")
- `data-loop` - Enable loop mode ("true"/"false")
- `data-autoplay` - Autoplay delay in milliseconds

## Usage Examples

### Basic Card Swiper
```html
<div class="swiper wit-swiper" 
     data-slides="1.2" 
     data-space="24" 
     data-breakpoints='{"450":{"slidesPerView":2.2},"768":{"slidesPerView":2.45}}'>
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- content --></div>
  </div>
</div>
```

### Gallery Swiper
```html
<div class="swiper wit-swiper" 
     data-slides="1" 
     data-space="16">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- content --></div>
  </div>
  <div class="swiper-pagination"></div>
</div>
```

### Video Swiper with Responsive Breakpoints
```html
<div class="swiper wit-swiper" 
     data-slides="2.25" 
     data-space="16" 
     data-breakpoints='{"992":{"slidesPerView":2.7}}'>
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- content --></div>
  </div>
</div>
```

### Review Cards (Compact Spacing)
```html
<div class="swiper wit-swiper" 
     data-slides="1.8" 
     data-space="8" 
     data-breakpoints='{"450":{"slidesPerView":2.8},"768":{"slidesPerView":3.1},"992":{"slidesPerView":3.5}}'>
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- content --></div>
  </div>
</div>
```

### 4-Column Layout
```html
<div class="swiper wit-swiper" 
     data-slides="1.4" 
     data-space="16" 
     data-breakpoints='{"450":{"slidesPerView":2.2},"767":{"slidesPerView":3.2},"992":{"slidesPerView":3.65},"1200":{"slidesPerView":4.5,"spaceBetween":16}}'>
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- content --></div>
  </div>
</div>
```

### Nested Image Swiper (Backwards Compatible)
```html
<div class="swiper wit-swiper-card_img" data-nested="true">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- content --></div>
  </div>
  <div class="swiper-pagination"></div>
</div>
```

## Breakpoints Configuration

Breakpoints are defined as a JSON object where keys are pixel widths and values are configuration objects:

```json
{
  "450": {
    "slidesPerView": 2.2
  },
  "768": {
    "slidesPerView": 3.1
  },
  "992": {
    "slidesPerView": 3.65,
    "spaceBetween": 20
  }
}
```

## Files Updated

### JavaScript Files
- `script.js` - Main unified implementation
- `assets/js/single-venue.js` - Single venue page
- `assets/js/archive-venue.js` - Archive venue page

### HTML/PHP Templates
- `single-venue.php`
- `archive-venue.php`
- `single-venue.htm`
- `archive-venue.html`

### CSS/SCSS Files
- `styles/card.scss` - Updated from `.wit-swiper-card` to `.wit-swiper`
- `styles/single-venue.scss` - Updated gallery and video swiper styles

## Benefits

1. **DRY Code**: Single initialization function instead of multiple duplicates
2. **Flexibility**: Easy to configure per-instance without modifying JavaScript
3. **Maintainability**: Changes to swiper behavior only need to be made in one place
4. **Scalability**: Adding new swiper variants doesn't require new classes or JS code
5. **Cleaner HTML**: No more multiple modifier classes like `wit-swiper-card wit-swiper-card_col4`

## Migration Checklist

- [x] Consolidated JavaScript initialization functions
- [x] Updated all PHP template files with data attributes
- [x] Updated all HTML prototype files
- [x] Unified CSS classes
- [x] Added comprehensive documentation
- [x] Maintained backwards compatibility for nested image swipers

## Backwards Compatibility

The `.wit-swiper-card_img` class is maintained for backwards compatibility with nested image swipers inside cards. This can be migrated later if needed.

## Special Cases

### Gallery Modal Swipers
Gallery modal swipers with thumbnails still use custom initialization due to the need for linking main and thumbnail swipers:
- `.wit-gallery-modal-single-swiper`
- `.wit-swiper-gallery-thumbnails-swiper`

### Video Modal Swipers
Video modal swipers follow the same pattern as gallery modals:
- `.wit-vdo-modal-single-swiper`
- `.wit-swiper-vdo-thumbnails-swiper`

### Header Venue Swiper
The header venue swiper has responsive initialization logic (desktop only) and maintains its specific selector:
- `.wit-sc_header_venue_swiper`

## Support

For questions or issues with the new swiper implementation, please refer to the inline documentation in `script.js` or consult the Swiper.js official documentation at https://swiperjs.com/
