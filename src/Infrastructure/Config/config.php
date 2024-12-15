<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yeremi\Ingresso\Application\UseCases\FetchEventsUseCase;
use Yeremi\Ingresso\Application\UseCases\FetchPassportPromotionUseCase;
use Yeremi\Ingresso\Application\UseCases\FetchSessionsUseCase;
use Yeremi\Ingresso\Application\UseCases\FetchTemplatesUseCase;
use Yeremi\Ingresso\Domain\Entity\SettingsEntity;
use Yeremi\Ingresso\Domain\Repositories\EventsRepositoryInterface;
use Yeremi\Ingresso\Domain\Repositories\PassportPromotionRepositoryInterface;
use Yeremi\Ingresso\Domain\Repositories\SessionsRepositoryInterface;
use Yeremi\Ingresso\Domain\Repositories\TemplatesRepositoryInterface;
use Yeremi\Ingresso\Infrastructure\API\DataHandler;
use Yeremi\Ingresso\Infrastructure\API\DataHandlerInterface;
use Yeremi\Ingresso\Infrastructure\API\IngressoCom\DataFetcher;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\EventsRepository;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\PassportPromotionRepository;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\SessionsRepository;
use Yeremi\Ingresso\Infrastructure\Integration\Repository\TemplatesRepository;
use Yeremi\Ingresso\Infrastructure\WordPress\Controllers\EventsPageController;
use Yeremi\Ingresso\Infrastructure\WordPress\Controllers\EventPageController;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\EventsHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\PassportPromotionHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\SessionsHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\TemplatesHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Filters\TheatersHookHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Routing\RewriteRule;
use Yeremi\Ingresso\Infrastructure\WordPress\Routing\RewriteRuleHandler;
use Yeremi\Ingresso\Infrastructure\WordPress\Templates\TemplateLoader;
use Yeremi\Ingresso\Infrastructure\WordPress\Templates\TemplateLocator;
use Yeremi\Ingresso\Infrastructure\WordPress\Templates\TemplatePathResolver;
use Yeremi\Ingresso\Presentation\Admin\AdminRenderer;
use Yeremi\Ingresso\Presentation\Admin\AdminRendererInterface;
use Yeremi\Ingresso\Presentation\Admin\SettingsManagerInterface;
use Yeremi\Ingresso\Presentation\Admin\SettingsManagerManager;
use Yeremi\Ingresso\Presentation\Admin\SettingsPage;
use Yeremi\Ingresso\Presentation\Admin\TemplateRendererFactory;
use Yeremi\Ingresso\Presentation\Frontend\ScriptsRegistration;
use Yeremi\Ingresso\Presentation\Frontend\StylesRegistration;

use function DI\autowire;
use function DI\factory;

return [
    DataFetcher::class => autowire(DataFetcher::class),
    DataHandlerInterface::class => autowire(DataHandler::class),
    RewriteRuleHandler::class => autowire(RewriteRuleHandler::class),
    TemplateLoader::class => autowire(),
    TemplateLocator::class => autowire(),
    TemplatePathResolver::class => autowire(),
    TemplateRendererFactory::class => factory(static function (ContainerInterface $container): TemplateRendererFactory {
        /** @var AdminRendererInterface $adminRenderer */
        $adminRenderer = $container->get(AdminRendererInterface::class);
        return new TemplateRendererFactory($adminRenderer);
    }),

    /**
     * WordPress Hooks
     */
    EventsHookHandler::class => autowire(),
    PassportPromotionHookHandler::class => autowire(),
    SessionsHookHandler::class => autowire(),
    TemplatesHookHandler::class => autowire(),
    TheatersHookHandler::class => autowire(),
    /**
     * Repositories
     */
    EventsRepositoryInterface::class => autowire(EventsRepository::class),
    PassportPromotionRepositoryInterface::class => autowire(PassportPromotionRepository::class),
    SessionsRepositoryInterface::class => autowire(SessionsRepository::class),
    TemplatesRepositoryInterface::class => autowire(TemplatesRepository::class),
    /**
     * Use cases
     */
    FetchEventsUseCase::class => autowire(),
    FetchPassportPromotionUseCase::class => autowire(),
    FetchSessionsUseCase::class => autowire(),
    FetchTemplatesUseCase::class => autowire(),
    /**
     * Backend
     */
    AdminRendererInterface::class => autowire(AdminRenderer::class),
    SettingsManagerInterface::class => autowire(SettingsManagerManager::class),
    SettingsPage::class => factory(static function (ContainerInterface $container): SettingsPage {
        /** @var TemplateRendererFactory $renderer */
        $renderer = $container->get(TemplateRendererFactory::class);
        /** @var SettingsManagerInterface $settingsManager */
        $settingsManager = $container->get(SettingsManagerInterface::class);
        $settingsEntity = new SettingsEntity();
        $adminPage = new SettingsPage($renderer, $settingsManager, $settingsEntity);
        $adminPage->init();
        return $adminPage;
    }),
    /**
     * Frontend
     */
    StylesRegistration::class => autowire(StylesRegistration::class),
    ScriptsRegistration::class => autowire(ScriptsRegistration::class),
    RewriteRule::class . 'Film' => factory(static fn (): RewriteRule => new RewriteRule('cinema/([a-zA-Z0-9-]+)', 'film_id')),
    RewriteRule::class . 'Cinema' => factory(static fn (): RewriteRule => new RewriteRule('cinema', 'cinema_page')),
    EventsPageController::class => factory(static function (ContainerInterface $container): EventsPageController {
        /** @var RewriteRuleHandler $rewriteRuleHandler */
        $rewriteRuleHandler = $container->get(RewriteRuleHandler::class);
        /** @var RewriteRule $rewriteRule */
        $rewriteRule = $container->get(RewriteRule::class . 'Cinema');
        /** @var TemplateLoader $templateLoader */
        $templateLoader = $container->get(TemplateLoader::class);
        $object = new EventsPageController($rewriteRuleHandler, $rewriteRule, $templateLoader);
        $object->register();
        return $object;
    }),
    EventPageController::class => factory(static function (ContainerInterface $container): EventPageController {
        /** @var RewriteRuleHandler $rewriteRuleHandler */
        $rewriteRuleHandler = $container->get(RewriteRuleHandler::class);
        /** @var RewriteRule $rewriteRule */
        $rewriteRule = $container->get(RewriteRule::class . 'Film');
        /** @var TemplateLoader $templateLoader */
        $templateLoader = $container->get(TemplateLoader::class);
        $object = new EventPageController($rewriteRuleHandler, $rewriteRule, $templateLoader);
        $object->register();
        return $object;
    }),
];
