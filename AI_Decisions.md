# AI_DECISIONS.md

### AI_DECISIONS.md

## 1. Fixed Content Was Not Editable

**Issue:**  
The initial implementation used fixed content for sections such as Hero, Statistics, Features, and Services.

**How I identified it:**  
The website looked correct, but a non-technical client could not update the content.

**What I changed:**  
I used WordPress Customizer options for key homepage content and WordPress's built-in Posts system for articles.

---

## 2. Article Section Used a Fixed Template

**Issue:**  
The initial approach suggested manually adding article content in the homepage template.

**How I identified it:**  
This would require code changes whenever a client wanted to add a new article.

**What I changed:**  
I replaced the fixed articles with a dynamic `WP_Query` that automatically displays published WordPress posts, including featured image, category, title, excerpt, and link.

---

## 3. Mobile-Only Responsive Approach Was Incomplete

**Issue:**  
The initial responsive styling focused mainly on mobile screens and caused layout issues on tablet-sized devices.

**How I identified it:**  
The layout changed unexpectedly between desktop, tablet, and mobile widths.

**What I changed:**  
I improved the responsive CSS with better breakpoints for desktop, tablet, and mobile, including the navigation menu, grids, statistics, and content layout.
