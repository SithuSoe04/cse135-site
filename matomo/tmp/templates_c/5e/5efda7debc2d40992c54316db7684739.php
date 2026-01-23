<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @CoreHome/_headerMessage.twig */
class __TwigTemplate_342c588abd840c4b66762a6e478cb22b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $context["updateCheck"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            yield "    <span id=\"updateCheckLinkContainer\">
        <span class=\"icon icon-fixed icon-reload\"></span>
        ";
            // line 4
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()(((((array_key_exists("lastUpdateCheckFailed", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["lastUpdateCheckFailed"]) || array_key_exists("lastUpdateCheckFailed", $context) ? $context["lastUpdateCheckFailed"] : (function () { throw new RuntimeError('Variable "lastUpdateCheckFailed" does not exist.', 4, $this->source); })()), false)) : (false))) ? ("General_ErrorTryAgain") : ("CoreHome_CheckForUpdates"))), "html", null, true);
            yield "
    </span>
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 7
        yield "
";
        // line 8
        if ((        // line 9
(isset($context["isAutoUpdateEnabled"]) || array_key_exists("isAutoUpdateEnabled", $context) ? $context["isAutoUpdateEnabled"] : (function () { throw new RuntimeError('Variable "isAutoUpdateEnabled" does not exist.', 9, $this->source); })()) && ((((        // line 10
(isset($context["latest_version_available"]) || array_key_exists("latest_version_available", $context) ? $context["latest_version_available"] : (function () { throw new RuntimeError('Variable "latest_version_available" does not exist.', 10, $this->source); })()) && (isset($context["hasSomeViewAccess"]) || array_key_exists("hasSomeViewAccess", $context) ? $context["hasSomeViewAccess"] : (function () { throw new RuntimeError('Variable "hasSomeViewAccess" does not exist.', 10, $this->source); })())) &&  !(isset($context["isUserIsAnonymous"]) || array_key_exists("isUserIsAnonymous", $context) ? $context["isUserIsAnonymous"] : (function () { throw new RuntimeError('Variable "isUserIsAnonymous" does not exist.', 10, $this->source); })())) && (isset($context["showUpdateNotificationToUser"]) || array_key_exists("showUpdateNotificationToUser", $context) ? $context["showUpdateNotificationToUser"] : (function () { throw new RuntimeError('Variable "showUpdateNotificationToUser" does not exist.', 10, $this->source); })())) || (        // line 12
(isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 12, $this->source); })()) && ((((        // line 14
array_key_exists("isManualUpdateCheck", $context) && (isset($context["isManualUpdateCheck"]) || array_key_exists("isManualUpdateCheck", $context) ? $context["isManualUpdateCheck"] : (function () { throw new RuntimeError('Variable "isManualUpdateCheck" does not exist.', 14, $this->source); })())) && array_key_exists("lastUpdateCheckFailed", $context)) && (isset($context["lastUpdateCheckFailed"]) || array_key_exists("lastUpdateCheckFailed", $context) ? $context["lastUpdateCheckFailed"] : (function () { throw new RuntimeError('Variable "lastUpdateCheckFailed" does not exist.', 14, $this->source); })())) || (        // line 15
array_key_exists("isAdminArea", $context) && (isset($context["isAdminArea"]) || array_key_exists("isAdminArea", $context) ? $context["isAdminArea"] : (function () { throw new RuntimeError('Variable "isAdminArea" does not exist.', 15, $this->source); })()))))))) {
            // line 19
            yield "<div
    vue-entry=\"CoreHome.VersionInfoHeaderMessage\"
    last-update-check-failed=\"";
            // line 21
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("lastUpdateCheckFailed", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["lastUpdateCheckFailed"]) || array_key_exists("lastUpdateCheckFailed", $context) ? $context["lastUpdateCheckFailed"] : (function () { throw new RuntimeError('Variable "lastUpdateCheckFailed" does not exist.', 21, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    latest-version-available=\"";
            // line 22
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("latest_version_available", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["latest_version_available"]) || array_key_exists("latest_version_available", $context) ? $context["latest_version_available"] : (function () { throw new RuntimeError('Variable "latest_version_available" does not exist.', 22, $this->source); })()), null)) : (null))), "html", null, true);
            yield "\"
    is-multi-server-environment=\"";
            // line 23
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("isMultiServerEnvironment", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["isMultiServerEnvironment"]) || array_key_exists("isMultiServerEnvironment", $context) ? $context["isMultiServerEnvironment"] : (function () { throw new RuntimeError('Variable "isMultiServerEnvironment" does not exist.', 23, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    is-super-user=\"";
            // line 24
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("isSuperUser", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 24, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    is-admin-area=\"";
            // line 25
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("isAdminArea", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["isAdminArea"]) || array_key_exists("isAdminArea", $context) ? $context["isAdminArea"] : (function () { throw new RuntimeError('Variable "isAdminArea" does not exist.', 25, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    is-internet-enabled=\"";
            // line 26
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("isInternetEnabled", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["isInternetEnabled"]) || array_key_exists("isInternetEnabled", $context) ? $context["isInternetEnabled"] : (function () { throw new RuntimeError('Variable "isInternetEnabled" does not exist.', 26, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    update-check=\"";
            // line 27
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("updateCheck", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["updateCheck"]) || array_key_exists("updateCheck", $context) ? $context["updateCheck"] : (function () { throw new RuntimeError('Variable "updateCheck" does not exist.', 27, $this->source); })()))) : (""))), "html", null, true);
            yield "\"
    has-some-view-access=\"";
            // line 28
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("hasSomeViewAccess", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["hasSomeViewAccess"]) || array_key_exists("hasSomeViewAccess", $context) ? $context["hasSomeViewAccess"] : (function () { throw new RuntimeError('Variable "hasSomeViewAccess" does not exist.', 28, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    is-anonymous=\"";
            // line 29
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("isUserIsAnonymous", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["isUserIsAnonymous"]) || array_key_exists("isUserIsAnonymous", $context) ? $context["isUserIsAnonymous"] : (function () { throw new RuntimeError('Variable "isUserIsAnonymous" does not exist.', 29, $this->source); })()), false)) : (false))), "html", null, true);
            yield "\"
    contact-email=\"";
            // line 30
            yield \Piwik\piwik_escape_filter($this->env, json_encode((isset($context["contactEmail"]) || array_key_exists("contactEmail", $context) ? $context["contactEmail"] : (function () { throw new RuntimeError('Variable "contactEmail" does not exist.', 30, $this->source); })())), "html", null, true);
            yield "\"
    piwik-version=\"";
            // line 31
            yield \Piwik\piwik_escape_filter($this->env, json_encode(((array_key_exists("piwik_version", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["piwik_version"]) || array_key_exists("piwik_version", $context) ? $context["piwik_version"] : (function () { throw new RuntimeError('Variable "piwik_version" does not exist.', 31, $this->source); })()), null)) : (null))), "html", null, true);
            yield "\"
    class=\"borderedControl piwikTopControl\"
></div>

<span class=\"icon icon-arrowup\"></span>
<div style=\"clear:right\"></div>
";
        } else {
            // line 38
            yield "<span class=\"icon icon-arrowup\"></span>
";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@CoreHome/_headerMessage.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  115 => 38,  105 => 31,  101 => 30,  97 => 29,  93 => 28,  89 => 27,  85 => 26,  81 => 25,  77 => 24,  73 => 23,  69 => 22,  65 => 21,  61 => 19,  59 => 15,  58 => 14,  57 => 12,  56 => 10,  55 => 9,  54 => 8,  51 => 7,  44 => 4,  40 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% set updateCheck %}
    <span id=\"updateCheckLinkContainer\">
        <span class=\"icon icon-fixed icon-reload\"></span>
        {{ (lastUpdateCheckFailed|default(false) ? 'General_ErrorTryAgain' : 'CoreHome_CheckForUpdates')|translate }}
    </span>
{% endset %}

{% if
    isAutoUpdateEnabled and (
        (latest_version_available and hasSomeViewAccess and not isUserIsAnonymous and showUpdateNotificationToUser)
        or (
            isSuperUser
            and (
                (isManualUpdateCheck is defined and isManualUpdateCheck and lastUpdateCheckFailed is defined and lastUpdateCheckFailed)
                or (isAdminArea is defined and isAdminArea)
            )
        )
    ) %}
<div
    vue-entry=\"CoreHome.VersionInfoHeaderMessage\"
    last-update-check-failed=\"{{ lastUpdateCheckFailed|default(false)|json_encode }}\"
    latest-version-available=\"{{ latest_version_available|default(null)|json_encode }}\"
    is-multi-server-environment=\"{{ isMultiServerEnvironment|default(false)|json_encode }}\"
    is-super-user=\"{{ isSuperUser|default(false)|json_encode }}\"
    is-admin-area=\"{{ isAdminArea|default(false)|json_encode }}\"
    is-internet-enabled=\"{{ isInternetEnabled|default(false)|json_encode }}\"
    update-check=\"{{ updateCheck|default|json_encode }}\"
    has-some-view-access=\"{{ hasSomeViewAccess|default(false)|json_encode }}\"
    is-anonymous=\"{{ isUserIsAnonymous|default(false)|json_encode }}\"
    contact-email=\"{{ contactEmail|json_encode }}\"
    piwik-version=\"{{ piwik_version|default(null)|json_encode }}\"
    class=\"borderedControl piwikTopControl\"
></div>

<span class=\"icon icon-arrowup\"></span>
<div style=\"clear:right\"></div>
{% else %}
<span class=\"icon icon-arrowup\"></span>
{% endif %}
", "@CoreHome/_headerMessage.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/CoreHome/templates/_headerMessage.twig");
    }
}
