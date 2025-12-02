# phpDocumentor LLMs Template

LLM-friendly single-file documentation template for [phpDocumentor](https://www.phpdoc.org/).

Generates documentation in a format optimized for Large Language Models (LLMs) context input.

## Output

This template generates two files:

| File | Description |
|------|-------------|
| `llms.txt` | Index file with namespace overview and class list |
| `llms-full.txt` | Complete API documentation in a single file |

## Installation

```bash
composer require --dev cyto/phpdocumentor-llms
```

## Usage

### Command Line

```bash
phpdoc --directory=src --target=docs --template="vendor/cyto/phpdocumentor-llms/themes/llms"
```

### Configuration File (phpdoc.xml)

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<phpdocumentor configVersion="3">
    <template name="vendor/cyto/phpdocumentor-llms/themes/llms"/>
</phpdocumentor>
```

### Composer Script

```json
{
    "scripts": {
        "docs:llms": "phpdoc --directory=src --target=docs --template='vendor/cyto/phpdocumentor-llms/themes/llms'"
    }
}
```

Then run:

```bash
composer docs:llms
```

## Example Output

### llms.txt (Index)

```markdown
# My Project

> API Documentation for My Project

## Overview

This documentation covers the following namespaces:

- `\App\Controller` (5 classes)
- `\App\Service` (3 classes)
- `\App\Repository` (2 classes, 1 interfaces)

## Classes

- `\App\Controller\UserController`: Handles user-related HTTP requests
- `\App\Service\AuthService`: Authentication and authorization service
...
```

### llms-full.txt (Full Documentation)

```markdown
# My Project - Full API Documentation

> Complete API documentation for My Project

---

## \App\Controller\UserController

Handles user-related HTTP requests

- **Type**: Class
- **Extends**: `\App\Controller\AbstractController`

### Methods

#### index()

\`\`\`php
public index(): Response
\`\`\`

Returns list of all users.

**Returns:** Response - JSON response with user list

---
...
```

## Use Cases

- **AI Code Assistants**: Feed API documentation as context to Claude, GPT, etc.
- **RAG Systems**: Single file is easier to chunk and index
- **Code Reviews**: Quick reference for understanding project structure

## Related

- [llms.txt specification](https://llmstxt.org/)
- [phpDocumentor](https://www.phpdoc.org/)
- [saggre/phpdocumentor-markdown](https://github.com/Saggre/phpDocumentor-markdown) - Markdown template (this project was inspired by)

## License

MIT
