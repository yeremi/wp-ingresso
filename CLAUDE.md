# wp-ingresso

Custom WordPress plugin (PHP ^8.2, PHP-DI) built on my libraries `yeremi/route-mapper` and `yeremi/schema-mapper`. PHP in `src/`, templates in `templates/`, assets in `resources/` (Tailwind/SCSS + webpack, video.js).

## Commands
- `composer test` — PHPUnit (Brain Monkey)
- `composer cs-check` / `composer cs-fix` — phpcs with inpsyde/php-coding-standards
- `composer psalm-check` — Psalm
- `composer rector-check` / `composer rector-fix` — Rector
- `npm run build` — production build (`build.sh`); `npm run dev:js` / `npm run dev:scss` — watch
- `npx wp-env start` — local WordPress

CI (`quality-assurance.yml`) uses inpsyde reusable workflows for coding standards, static analysis and unit tests — run `composer cs-check`, `composer psalm-check` and `composer test` before finishing.
If a bug comes from route-mapper or schema-mapper, fix it in that library instead of working around it here.
