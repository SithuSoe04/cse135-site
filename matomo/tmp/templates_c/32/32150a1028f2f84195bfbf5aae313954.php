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

/* ajaxMacros.twig */
class __TwigTemplate_92368b24632ff73b504aef320fe4105e extends Template
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
        // line 4
        yield "
";
        // line 16
        yield "
";
        return; yield '';
    }

    // line 1
    public function macro_errorDiv($__id__ = "ajaxError", ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "id" => $__id__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            yield "    <div id=\"";
            yield \Piwik\piwik_escape_filter($this->env, (isset($context["id"]) || array_key_exists("id", $context) ? $context["id"] : (function () { throw new RuntimeError('Variable "id" does not exist.', 2, $this->source); })()), "html", null, true);
            yield "\" style=\"display:none\"></div>
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 5
    public function macro_loadingDiv($__id__ = "ajaxLoadingDiv", ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "id" => $__id__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 6
            yield "<div id=\"";
            yield \Piwik\piwik_escape_filter($this->env, (isset($context["id"]) || array_key_exists("id", $context) ? $context["id"] : (function () { throw new RuntimeError('Variable "id" does not exist.', 6, $this->source); })()), "html", null, true);
            yield "\" style=\"display:none;\">
    <div class=\"loadingPiwik\">
        ";
            // line 8
            yield from             $this->loadTemplate("@CoreHome/_loader.twig", "ajaxMacros.twig", 8)->unwrap()->yield($context);
            // line 9
            yield "        ";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_LoadingData"), "html", null, true);
            yield "
    </div>
    <div class=\"loadingSegment\">
        ";
            // line 12
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_LoadingSegmentedDataMayTakeSomeTime"), "html", null, true);
            yield "
    </div>
</div>
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 17
    public function macro_requestErrorDiv($__contactEmail__ = null, $__areAdsForProfessionalServicesEnabled__ = false, $__currentModule__ = "", $__showMoreHelp__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "contactEmail" => $__contactEmail__,
            "areAdsForProfessionalServicesEnabled" => $__areAdsForProfessionalServicesEnabled__,
            "currentModule" => $__currentModule__,
            "showMoreHelp" => $__showMoreHelp__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 18
            yield "    <div id=\"loadingError\">
        <div class=\"alert alert-danger\">
            ";
            // line 20
            if ((array_key_exists("contactEmail", $context) && (isset($context["contactEmail"]) || array_key_exists("contactEmail", $context) ? $context["contactEmail"] : (function () { throw new RuntimeError('Variable "contactEmail" does not exist.', 20, $this->source); })()))) {
                // line 21
                yield "                ";
                yield $this->env->getFilter('translate')->getCallable()("General_ErrorRequest", (("<a href=\"mailto:" . \Piwik\piwik_escape_filter($this->env, (isset($context["contactEmail"]) || array_key_exists("contactEmail", $context) ? $context["contactEmail"] : (function () { throw new RuntimeError('Variable "contactEmail" does not exist.', 21, $this->source); })()), "url")) . "\">"), "</a>");
                yield "
            ";
            } else {
                // line 23
                yield "                ";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_ErrorRequest", "", ""), "html", null, true);
                yield "
            ";
            }
            // line 25
            yield "
            <br /><br />
            ";
            // line 27
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_NeedMoreHelp"), "html", null, true);
            yield "

            ";
            // line 29
            if ((isset($context["showMoreHelp"]) || array_key_exists("showMoreHelp", $context) ? $context["showMoreHelp"] : (function () { throw new RuntimeError('Variable "showMoreHelp" does not exist.', 29, $this->source); })())) {
                // line 30
                yield "            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/faq/troubleshooting/faq_19489/"), "html", null, true);
                yield "\">";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Faq"), "html", null, true);
                yield "</a> –
            ";
            }
            // line 32
            yield "            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://forum.matomo.org/"), "html", null, true);
            yield "\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Feedback_CommunityHelp"), "html", null, true);
            yield "</a>";
            // line 34
            if ((isset($context["areAdsForProfessionalServicesEnabled"]) || array_key_exists("areAdsForProfessionalServicesEnabled", $context) ? $context["areAdsForProfessionalServicesEnabled"] : (function () { throw new RuntimeError('Variable "areAdsForProfessionalServicesEnabled" does not exist.', 34, $this->source); })())) {
                // line 35
                yield "                –
                <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"";
                // line 36
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/support-plans", null, null, "AjaxError"), "html", null, true);
                yield "\">";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Feedback_ProfessionalHelp"), "html", null, true);
                yield "</a>";
            }
            // line 37
            yield ".
        </div>
    </div>
    <div id=\"loadingRateLimitError\" style=\"display: none\">
        <div class=\"alert alert-danger\">
            ";
            // line 42
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_ErrorRateLimit"), "html", null, true);
            yield "

            <br /><br />
            ";
            // line 45
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_NeedMoreHelp"), "html", null, true);
            yield "

            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"";
            // line 47
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://forum.matomo.org/"), "html", null, true);
            yield "\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Feedback_CommunityHelp"), "html", null, true);
            yield "</a>";
            // line 49
            if ((isset($context["areAdsForProfessionalServicesEnabled"]) || array_key_exists("areAdsForProfessionalServicesEnabled", $context) ? $context["areAdsForProfessionalServicesEnabled"] : (function () { throw new RuntimeError('Variable "areAdsForProfessionalServicesEnabled" does not exist.', 49, $this->source); })())) {
                // line 50
                yield "            –
            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"";
                // line 51
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/support-plans", null, null, "AjaxError"), "html", null, true);
                yield "\">";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Feedback_ProfessionalHelp"), "html", null, true);
                yield "</a>";
            }
            // line 52
            yield ".
        </div>
    </div>
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "ajaxMacros.twig";
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
        return array (  208 => 52,  202 => 51,  199 => 50,  197 => 49,  192 => 47,  187 => 45,  181 => 42,  174 => 37,  168 => 36,  165 => 35,  163 => 34,  157 => 32,  149 => 30,  147 => 29,  142 => 27,  138 => 25,  132 => 23,  126 => 21,  124 => 20,  120 => 18,  105 => 17,  95 => 12,  88 => 9,  86 => 8,  80 => 6,  68 => 5,  59 => 2,  47 => 1,  41 => 16,  38 => 4,);
    }

    public function getSourceContext()
    {
        return new Source("{% macro errorDiv(id='ajaxError') %}
    <div id=\"{{ id }}\" style=\"display:none\"></div>
{% endmacro %}

{% macro loadingDiv(id='ajaxLoadingDiv') %}
<div id=\"{{ id }}\" style=\"display:none;\">
    <div class=\"loadingPiwik\">
        {% include \"@CoreHome/_loader.twig\" %}
        {{ 'General_LoadingData'|translate }}
    </div>
    <div class=\"loadingSegment\">
        {{ 'SegmentEditor_LoadingSegmentedDataMayTakeSomeTime'|translate }}
    </div>
</div>
{% endmacro %}

{% macro requestErrorDiv(contactEmail, areAdsForProfessionalServicesEnabled = false, currentModule = '', showMoreHelp = false) %}
    <div id=\"loadingError\">
        <div class=\"alert alert-danger\">
            {% if contactEmail is defined and contactEmail %}
                {{ 'General_ErrorRequest'|translate('<a href=\"mailto:' ~ contactEmail|e('url') ~ '\">', '</a>')|raw }}
            {% else %}
                {{ 'General_ErrorRequest'|translate('', '') }}
            {% endif %}

            <br /><br />
            {{ 'General_NeedMoreHelp'|translate }}

            {% if showMoreHelp %}
            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"{{ 'https://matomo.org/faq/troubleshooting/faq_19489/'|trackmatomolink }}\">{{ 'General_Faq'|translate }}</a> –
            {% endif %}
            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"{{ 'https://forum.matomo.org/'|trackmatomolink }}\">{{ 'Feedback_CommunityHelp'|translate }}</a>

            {%- if areAdsForProfessionalServicesEnabled %}
                –
                <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"{{ 'https://matomo.org/support-plans'|trackmatomolink(null, null, 'AjaxError')}}\">{{ 'Feedback_ProfessionalHelp'|translate }}</a>
            {%- endif %}.
        </div>
    </div>
    <div id=\"loadingRateLimitError\" style=\"display: none\">
        <div class=\"alert alert-danger\">
            {{ 'General_ErrorRateLimit'|translate }}

            <br /><br />
            {{ 'General_NeedMoreHelp'|translate }}

            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"{{ 'https://forum.matomo.org/'|trackmatomolink }}\">{{ 'Feedback_CommunityHelp'|translate }}</a>

            {%- if areAdsForProfessionalServicesEnabled %}
            –
            <a rel=\"noreferrer noopener\" target=\"_blank\" href=\"{{ 'https://matomo.org/support-plans'|trackmatomolink(null, null, 'AjaxError')}}\">{{ 'Feedback_ProfessionalHelp'|translate }}</a>
            {%- endif %}.
        </div>
    </div>
{% endmacro %}
", "ajaxMacros.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/Morpheus/templates/ajaxMacros.twig");
    }
}
