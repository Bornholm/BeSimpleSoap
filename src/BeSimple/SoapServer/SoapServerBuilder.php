<?php

/*
 * This file is part of the BeSimpleSoapServer.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BeSimple\SoapServer;

use BeSimple\SoapCommon\SoapOptions\SoapOptions;
use BeSimple\SoapServer\SoapOptions\SoapServerOptions;

/**
 * SoapServerBuilder provides a SoapServer instance from SoapServerOptions and SoapOptions.
 *
 * @author Petr Bechyně <petr.bechyne@vodafone.com>
 */
class SoapServerBuilder
{
    /**
     * Builds a SoapServer instance.
     *
     * @param SoapServerOptions $soapServerOptions
     * @param SoapOptions $soapOptions
     *
     * @return SoapServer
     */
    public function build(SoapServerOptions $soapServerOptions, SoapOptions $soapOptions)
    {
        use_soap_error_handler($soapServerOptions->isErrorReporting());

        $server = new SoapServer($soapServerOptions, $soapOptions);
        if ($soapServerOptions->hasPersistence()) {
            $server->setPersistence($soapServerOptions->getPersistence());
        }
        if ($soapServerOptions->hasHandlerClass()) {
            $server->setClass($soapServerOptions->getHandlerClass());
        } else if ($soapServerOptions->hasHandlerObject()) {
            $server->setObject($soapServerOptions->getHandlerObject());
        }

        return $server;
    }
}
