<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * --------------------------------------------------------------------------
 * Content Security Policy Config
 * --------------------------------------------------------------------------
 *
 * Content Security Policy (CSP) is an added layer of security that helps to
 * detect and mitigate certain types of attacks, including Cross-Site Scripting
 * (XSS) and data injection attacks. These attacks are used for everything
 * from data theft to site defacement to distribution of malware.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP
 */
class ContentSecurityPolicy extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Enable
     * --------------------------------------------------------------------------
     *
     * If true, the CSP will be enabled.
     */
    public bool $enabled = false;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Report Only
     * --------------------------------------------------------------------------
     *
     * If true, the CSP will be enabled in report-only mode.
     */
    public bool $reportOnly = false;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Report URI
     * --------------------------------------------------------------------------
     *
     * Specifies a URL where the browser will send reports when a content
     * security policy violation occurs.
     */
    public ?string $reportURI = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Upgrade Insecure Requests
     * --------------------------------------------------------------------------
     *
     * If true, the browser will upgrade insecure requests to HTTPS.
     */
    public bool $upgradeInsecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Default Src
     * --------------------------------------------------------------------------
     *
     * The default-src directive defines the default policy for fetching resources
     * such as JavaScript, Images, CSS, Fonts, AJAX requests, Frames, HTML5 Media.
     *
     * @var list<string>|null
     */
    public array $defaultSrc = ['none'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Script Src
     * --------------------------------------------------------------------------
     *
     * The script-src directive restricts the sources of JavaScript.
     *
     * @var list<string>
     */
    public array $scriptSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Style Src
     * --------------------------------------------------------------------------
     *
     * The style-src directive restricts the sources of CSS.
     *
     * @var list<string>
     */
    public array $styleSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Image Src
     * --------------------------------------------------------------------------
     *
     * The img-src directive restricts the sources of images.
     *
     * @var list<string>
     */
    public array $imageSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Base URI
     * --------------------------------------------------------------------------
     *
     * The base-uri directive restricts the URLs which can be used in a document's
     * <base> element.
     *
     * @var list<string>|null
     */
    public ?array $baseURI = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Child Src
     * --------------------------------------------------------------------------
     *
     * The child-src directive restricts the URLs for workers and embedded frame contents.
     *
     * @var list<string>
     */
    public array $childSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Connect Src
     * --------------------------------------------------------------------------
     *
     * The connect-src directive restricts the URLs which can be loaded using script interfaces.
     *
     * @var list<string>
     */
    public array $connectSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Font Src
     * --------------------------------------------------------------------------
     *
     * The font-src directive restricts the URLs which can be loaded using @font-face.
     *
     * @var list<string>
     */
    public array $fontSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Form Action
     * --------------------------------------------------------------------------
     *
     * The form-action directive restricts the URLs which can be used as the target of a form submissions.
     *
     * @var list<string>
     */
    public array $formAction = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Frame Ancestors
     * --------------------------------------------------------------------------
     *
     * The frame-ancestors directive specifies the parents that may embed a page.
     *
     * @var list<string>|null
     */
    public ?array $frameAncestors = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Frame Src
     * --------------------------------------------------------------------------
     *
     * The frame-src directive restricts the URLs which can be loaded in frames.
     *
     * @var list<string>|null
     */
    public ?array $frameSrc = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Media Src
     * --------------------------------------------------------------------------
     *
     * The media-src directive restricts the URLs which can be loaded using video and audio.
     *
     * @var list<string>|null
     */
    public ?array $mediaSrc = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Object Src
     * --------------------------------------------------------------------------
     *
     * The object-src directive restricts the URLs which can be loaded using plugin technologies.
     *
     * @var list<string>
     */
    public array $objectSrc = ['self'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Plugin Types
     * --------------------------------------------------------------------------
     *
     * The plugin-types directive restricts the set of plugins that can be embedded into a document.
     *
     * @var list<string>|null
     */
    public ?array $pluginTypes = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Report To
     * --------------------------------------------------------------------------
     *
     * The report-to directive specifies a group of reporting endpoints to which the user agent should send reports.
     */
    public ?string $reportTo = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Sandbox
     * --------------------------------------------------------------------------
     *
     * The sandbox directive applies extra restrictions to the content in the page.
     *
     * @var list<string>|null
     */
    public ?array $sandbox = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Manifest Src
     * --------------------------------------------------------------------------
     *
     * The manifest-src directive restricts the URLs which can be loaded using a manifest.
     *
     * @var list<string>|null
     */
    public ?array $manifestSrc = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Worker Src
     * --------------------------------------------------------------------------
     *
     * The worker-src directive restricts the URLs which can be loaded as workers.
     *
     * @var list<string>|null
     */
    public ?array $workerSrc = null;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Script Nonce Tag
     * --------------------------------------------------------------------------
     *
     * The tag name to use for the script nonce.
     */
    public string $scriptNonceTag = '{csp-script-nonce}';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Style Nonce Tag
     * --------------------------------------------------------------------------
     *
     * The tag name to use for the style nonce.
     */
    public string $styleNonceTag = '{csp-style-nonce}';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy Auto Nonce
     * --------------------------------------------------------------------------
     *
     * If true, the system will automatically generate nonces for scripts and styles.
     */
    public bool $autoNonce = true;
}
