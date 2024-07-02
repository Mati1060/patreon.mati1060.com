# patreon.mati1060.com

patreon.mati1060.com is a simple web application that displays the contents of a directory with subpages for easier segregation of content by date.

**Note:** This repository contains the backend code for my website, patreon.mati1060.com. This website is not publicly accessible

## Features

- Reads content from `files/Creatror/yyyy/mm.yyyy/dd.mm directory name` and displays them.
- Individual subpages for the creator, year, month and day.
- Converting the date format form something like 06.2024 to June 2024.
- Ability to add preview images for individual creators and days, as well as tags for days.
- Support for a lot of common text, image and audio formats `txt, jpg jpeg png gif webp, mp3 wav ogg`

## Requirements

- Minimum php Version: PHP 5.3
- Files need be arranged in this way `Creatror/yyyy/mm.yyyy/dd.mm.directory name/some file name`
- The preview images displayed on the month page need to be named image and tags with their appropriate extensions
- The webserver used needs to support the file types that are being hosted.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Mati1060/patreon.mati1060.com.git
   ```

2. **Navigate to the project directory:**

   ```bash
   cd patreon.mati1060.com
   ```

3. **Ensure you have PHP and a web server installed (e.g. Apache, Nginx).**

4. **Create the files directory with is appropriate subdirectory’s, an valid file structure could be `files/Some name/2024/06.2024/05.06 Test 1`**

5. **Add preview images for creators in their directories, (e.g. `files/Some name/image.png`)**

6. **Add preview images and tags for days in their directories, (e.g. `files/Some name/2024/06.2024/05.06 Test 1/image.png` and `files/Some name/2024/06.2024/05.06 Test 1/tags.txt`)**

7. **Populate the individual day folders with their content, (e.g. `files/Some name/2024/06.2024/05.06 Test 1/info.txt`)**

## Note

- In the installation instructions the preview images have the extension `png` but it can be any of the supported extensions.

- This project is in no way associated with the company Patreon or the website patreon.com
