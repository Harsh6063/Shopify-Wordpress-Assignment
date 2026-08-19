# PROMPTS.md

## Project Understanding and Initial Setup

### Prompt 1

I am working on this project/assignment. First understand all the requirements from both the Shopify and WordPress parts. I want to first understand what I have to build, which task should be prioritized, what framework and tools I should use, and how I should plan the work based on the time limit. Provide a structured plan for the complete assignment.

### Why I Used This Prompt

I used this prompt to first understand the complete assignment before starting development. Since Task 2 was compulsory and Task 1 and Task 3 were bonus tasks, I wanted to understand what should be prioritized.

### What I Did

After understanding the requirements, I decided to prioritize:

1. Task 2 – WordPress Plugin
2. Task 3 – Frontend
3. Landing Page Assignment
4. Task 1 – Shopify integration

---

# WordPress and Shopify Initial Setup

### Prompt 2

I have set up WordPress and Shopify initially. I am using Local for the local WordPress setup, and I have also created and installed the Shopify app. The initial setup is done. Now help me understand what I should do next.

### Why I Used This Prompt

I used this prompt after completing the basic environment setup and needed a clear next step instead of randomly starting development.

### What I Did

I used:

- Local for local WordPress development
- Shopify for product and API setup
- A custom Shopify app
- A custom WordPress plugin

---

# WordPress Plugin Folder Setup

### Prompt 3

I have created a WordPress plugins folder called `shopify-products`. Now let's start working on Task 2. Give me the complete project structure first and explain what each file will do.

### Why I Used This Prompt

I wanted to create the correct project structure before adding functionality so the plugin would remain organized and reusable.

### What I Did

I created the initial plugin structure and separated:

- Main plugin functionality
- Shopify API handling
- WordPress Custom Post Type
- Shortcode functionality
- AJAX functionality
- CSS
- JavaScript
- Product templates

---

# Environment Configuration

### Prompt 4

Give me the code and structure for the `.env` setup. I have added the Client ID and password/API credentials. I want the credentials to be separated from the main plugin code.

### Why I Used This Prompt

I wanted to avoid placing Shopify credentials directly inside the main plugin files.

### What I Did

I created an environment configuration setup for the Shopify credentials and kept sensitive configuration separate from the main application logic.

---

# Main WordPress Plugin File

### Prompt 5

Now give me the `shopify-products.php` main plugin file. After this, we can start with the main functionality.

### Why I Used This Prompt

I wanted to create the main plugin entry point before adding additional features.

### What I Did

I added the plugin header and connected the main plugin structure with the required WordPress functionality.

---

# Registering the WordPress CPT

### Prompt 6

Now register the Custom Post Type for Shopify products. The Shopify products should be stored inside WordPress using a CPT. Once this is working, we can move to the layout structure.

### Why I Used This Prompt

The assignment specifically required storing and updating Shopify products using WordPress Custom Post Types.

### What I Did

I created a Custom Post Type for Shopify products so that product data could be stored and managed inside WordPress.

---

# Layout and Frontend Structure

### Prompt 7

Once the product data and CPT are working, let's work on the structure of the layout. I want a responsive product grid with product search, filters, and AJAX updates without reloading the page.

### Why I Used This Prompt

I wanted to separate the data and backend work from the frontend implementation.

### What I Did

I worked on:

- Responsive product grid
- Search functionality
- Product filtering
- AJAX updates
- Dynamic product display

---

# Starting the Landing Page AI Project

### Prompt 8

Let's start the AI project for the website. Recreate the provided landing page using either:

- Shopify using Liquid, Sections, and Blocks
- WordPress using a Custom Theme or Custom Gutenberg Blocks

Not allowed:

- Page builders such as Elementor

Requirements:

- Pixel-perfect design
- Fully responsive
- Editable by a non-technical client
- SEO-friendly
- Accessibility compliant
- Performance optimized
- Reusable components
- Clean folder structure

Remember these requirements when creating the project.

### Why I Used This Prompt

I wanted the AI to understand all the assignment requirements before generating the implementation.

### What I Did

I selected WordPress Custom Theme development instead of using a page builder.

---

# Initial Project Mapping

### Prompt 9

I am working on the landing page assignment. First help me understand the project structure, framework, tools, setup, and development approach. Based on the assignment requirements and the available time, tell me what I should prioritize.

### Why I Used This Prompt

I wanted to map the project before starting implementation.

### What I Did

I divided the work into:

1. Initial theme setup
2. Front-page structure
3. Header and hero
4. Homepage sections
5. Responsive design
6. Dynamic WordPress functionality
7. Articles
8. SEO and accessibility
9. Performance improvements
10. Final testing

---

# Using Built-in WordPress Articles

### Prompt 10

Remember that for articles I want to use Local WordPress and the built-in WordPress Posts and Add New Post system. I do not want the client to manually edit article content in the code. The other homepage sections should be customizable and friendly for a non-technical user.

### Why I Used This Prompt

The initial approach used fixed article cards, which did not satisfy the requirement that a non-technical client should be able to update content.

### What I Did

I changed the article section to use:

- WordPress Posts
- Featured Images
- Categories
- Dates
- Excerpts
- Dynamic `WP_Query`

A client can now add an article through:

```text
Dashboard → Posts → Add New
```

# AI Use and Manual Fixes

I initially used both Claude and ChatGPT to understand the project requirements, explore implementation approaches, and create the initial project structure.

During development, I used AI mainly for:

- Understanding WordPress and Shopify requirements
- Planning the project
- Creating the initial folder structure
- Generating initial code
- Debugging errors
- Fixing responsive issues
- Making content dynamic
- Implementing WordPress Customizer functionality
- Implementing dynamic articles
- Improving the mobile menu

However, AI responses were not always directly usable.

Some issues I had to identify and fix included:

- Fixed content that was not editable
- Fixed article templates instead of using WordPress Posts
- Mobile-focused responsive CSS without proper tablet testing
- PHP syntax and structure errors
- Duplicate or incorrect CSS media query structure
- Mobile menu issues
- Customizer values not updating correctly
