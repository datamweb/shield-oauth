import datetime
import re

# Get the current year
current_year = datetime.datetime.now().year

# Files to update
files = ["LICENSE", "mkdocs.yml"]

# Function to update the copyright year
def update_copyright(content):
    def replace_years(match):
        # Do not update if the text contains "Lonnie Ezell"
        if "Lonnie Ezell" in match.group(0):
            return match.group(0)
        # Otherwise, update the end year to the current year
        return f"{match.group(1)}-{current_year}"

    # Replace the last year with the current year
    return re.sub(r'(\d{4})-(\d{4})', replace_years, content)

# Process each file
for file in files:
    with open(file, 'r') as f:
        content = f.read()

    # Update the file content
    updated_content = update_copyright(content)

    with open(file, 'w') as f:
        f.write(updated_content)
