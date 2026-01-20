<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class DocTypes extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Valid DOCTYPEs
     * --------------------------------------------------------------------------
     *
     * This array contains the valid DOCTYPEs for the application.
     * The array keys are the names of the DOCTYPEs, and the values are the
     * DOCTYPE strings.
     *
     * @var array<string, string>
     */
    public array $list = [
        'xhtml11'             => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        'xhtml1-strict'       => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'xhtml1-transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'xhtml1-frame'        => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'html5'               => '<!DOCTYPE html>',
        'html4-strict'        => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
        'html4-transitional'  => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        'html4-frame'         => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
    ];

    /**
     * --------------------------------------------------------------------------
     * HTML 5 Void Elements
     * --------------------------------------------------------------------------
     *
     * This array contains the list of void elements in HTML5.
     *
     * @var list<string>
     */
    public array $html5 = [
        'area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img', 'input',
        'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr',
    ];

    /**
     * --------------------------------------------------------------------------
     * XHTML 1.1 Void Elements
     * --------------------------------------------------------------------------
     *
     * This array contains the list of void elements in XHTML 1.1.
     *
     * @var list<string>
     */
    public array $xhtml11 = [
        'area', 'base', 'br', 'col', 'hr', 'img', 'input', 'link', 'meta', 'param',
    ];
}
