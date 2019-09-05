<?php
namespace Bigbank\DigiDoc\Soap;

use Bigbank\DigiDoc\Exceptions\DigiDocException;

/**
 * A SOAP client that handles HTTP(S) proxy correctly
 */
class ProxyAwareClient extends \SoapClient implements SoapClientInterface
{

    /**
     * @param string     $function_name
     * @param array      $arguments
     * @param array|null $options
     * @param null       $input_headers
     * @param array|null $output_headers
     *
     * @return array
     * @throws DigiDocException
     */
    public function __soapCall(
        $function_name,
        $arguments,
        $options = null,
        $input_headers = null,
        &$output_headers = null
    ) {

        try {
            return parent::__soapCall($function_name, $arguments, $options, $input_headers, $output_headers);
        } catch (\SoapFault $fault) {
            throw new DigiDocException(
                $fault->getMessage(),
                $fault->getCode(),
                $fault
            );
        }
    }
}
