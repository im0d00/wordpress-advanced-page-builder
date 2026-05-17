# NexusBuilder

NexusBuilder is a modular WordPress page builder plugin scaffold with:

- Plugin bootstrap and singleton core
- DB installer (`nexusbuilder_data`, `nexusbuilder_revisions`, `nexusbuilder_templates`)
- Element system with 8 base elements
- REST routes for pages, templates, global styles, and AI
- Frontend renderer + scoped CSS generator
- React + TypeScript editor shell (Zustand undo/redo)
- Settings page scaffold with sanitization and encrypted AI key storage

## Development

### PHP

- Install deps: `composer install`
- Run tests: `vendor/bin/phpunit`

### Editor

- Install deps: `npm install`
- Build: `npm run build`

## Notes

This implementation provides a secure foundation for iterative expansion.
