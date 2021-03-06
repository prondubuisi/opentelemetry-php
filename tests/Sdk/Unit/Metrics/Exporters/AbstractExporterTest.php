<?php

declare(strict_types=1);

namespace OpenTelemetry\Tests\Sdk\Unit\Metrics\Exporters;

use OpenTelemetry\Metrics as API;
use OpenTelemetry\Sdk\Metrics\Exporters\AbstractExporter;
use PHPUnit\Framework\TestCase;

class AbstractExporterTest extends TestCase
{
    public function testEmptyMetricsExportReturnsSuccess()
    {
        $this->assertEquals(
            API\Exporter::SUCCESS,
            $this->getExporter()->export([])
        );
    }

    public function testErrorReturnsIfTryingToExportNotAMetric()
    {
        $this->assertEquals(
            API\Exporter::FAILED_NOT_RETRYABLE,
            $this->getExporter()->export([1])
        );
    }

    protected function getExporter(): AbstractExporter
    {
        return new class() extends AbstractExporter {
            protected function doExport(iterable $metrics): void
            {
            }
        };
    }
}
