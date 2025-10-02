# Custom Blocks for Gutenberg

**Custom Gutenberg blocks for WooCommerce**, built with React and PHP.  
Easily display your best-selling products directly in the WordPress editor.

## 📦 Features

- 🧩 Custom block: **Productos Más Vendidos**
- 🛒 Integrated with **WooCommerce**
- 🖥️ Live preview in block editor (React + REST API)
- 🧠 Server-side rendered on the front-end via PHP
- 🎨 Supports block alignment, spacing, background & text color
- 💅 SCSS/SASS support via `@wordpress/scripts`

## 🚀 Installation

1. Clone or download this repository:
   ```bash
   git clone https://github.com/lenafo/custom-blocks.git
   cd custom-blocks
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Build the plugin:
   ```bash
   npm run build
   ```

4. Upload the folder to `/wp-content/plugins/` or install via ZIP.

5. Activate the plugin from the **WordPress dashboard**.

## 🧩 Usage

- Go to any post or page using the block editor.
- Find **"Productos Más Vendidos"** under the "Custom Blocks" category.
- Use the sidebar panel to choose how many products to display.
- Products are loaded live in the editor from the WooCommerce REST API.
- The front-end is rendered using a PHP template (`render.php`).

## 🛠 Development

### Available Scripts

```bash
npm run start     # Development build (with file watching)
npm run build     # Production build
npm run lint      # Lint JavaScript
```

> Requires: Node.js, npm, and WordPress with WooCommerce installed and active.

## 📄 License

Licensed under the [GNU GPL v3.0](https://www.gnu.org/licenses/gpl-3.0.html).  
See [LICENSE](./LICENSE) for more details.

## 🙋 Author

Made with ❤️ by [@lenafo](https://github.com/lenafo)

---

✅ Contributions welcome — feel free to fork or submit pull requests!
