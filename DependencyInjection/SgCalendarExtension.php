<?php

namespace Sg\CalendarBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class SgCalendarExtension
 *
 * @package Sg\CalendarBundle\DependencyInjection
 */
class SgCalendarExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        // doctrine
        $container->setParameter('sg_calendar.doctrine.calendar.class', $config['calendar_class']);
        $container->setParameter('sg_calendar.doctrine.event.class', $config['event_class']);
        $container->setParameter('sg_calendar.doctrine.max_results', $config['max_results']);

        // twig
        $container->setParameter('sg_calendar.twig.fullcalendar_id', $config['fullcalendar_id']);
        $container->setParameter('sg_calendar.twig.datepicker_id', $config['datepicker_id']);
        $container->setParameter('sg_calendar.twig.first_day', $config['first_day']);
        $container->setParameter('sg_calendar.twig.time_format', $config['time_format']);

        // forms
        $container->setParameter('sg_calendar.form.calendar.name', $config['form']['calendar_name']);
        $container->setParameter('sg_calendar.form.calendar.type', $config['form']['calendar_type']);
        $container->setParameter('sg_calendar.form.event.name', $config['form']['event_name']);
        $container->setParameter('sg_calendar.form.event.type', $config['form']['event_type']);
    }
}
