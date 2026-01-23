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

/* @CorePluginsAdmin/tagManagerTeaser.twig */
class __TwigTemplate_5eceb5274319e349d1d62091bd730cab extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'topcontrols' => [$this, 'block_topcontrols'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "dashboard.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("dashboard.twig", "@CorePluginsAdmin/tagManagerTeaser.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_topcontrols($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 6
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        yield "<div class=\"activateTagManager\">
    <div class=\"row\">
        <div class=\"col s12\" style=\"text-align: center;\">
            <h2>";
        // line 10
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerNowAvailableTitle"), "html", null, true);
        yield "</h2>
            <p>";
        // line 11
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerNowAvailableSubtitle"), "html", null, true);
        yield "</p>
        </div>
    </div>
    ";
        // line 14
        $context["actionBlock"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 15
            yield "    <div class=\"row\">
        <div class=\"col s12\">
            <div style=\"text-align: center;\">
                ";
            // line 18
            if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 18, $this->source); })())) {
                // line 19
                yield "                    <a href=\"";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFunction('linkTo')->getCallable()(["module" => "CorePluginsAdmin", "action" => "activate", "nonce" => (isset($context["nonce"]) || array_key_exists("nonce", $context) ? $context["nonce"] : (function () { throw new RuntimeError('Variable "nonce" does not exist.', 19, $this->source); })()), "pluginName" => "TagManager", "redirectTo" => "tagmanager"]), "html", null, true);
                yield "\"
                       class=\"btn activateTagManagerPlugin\"><span class=\"icon-rocket\"></span> ";
                // line 20
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_ActivateTagManagerNow"), "html", null, true);
                yield " <span class=\"icon-rocket\"></span></a>
                ";
            } else {
                // line 22
                yield "                    <a href=\"mailto:";
                yield \Piwik\piwik_escape_filter($this->env, \Piwik\piwik_escape_filter($this->env, (isset($context["contactEmail"]) || array_key_exists("contactEmail", $context) ? $context["contactEmail"] : (function () { throw new RuntimeError('Variable "contactEmail" does not exist.', 22, $this->source); })()), "url"), "html", null, true);
                yield "?subject=";
                yield \Piwik\piwik_escape_filter($this->env, \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerNowAvailableTitle"), "url"), "html", null, true);
                yield "&body=";
                yield \Piwik\piwik_escape_filter($this->env, \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerTeaserEmailSuperUserBody", "

", "

", (isset($context["piwikUrl"]) || array_key_exists("piwikUrl", $context) ? $context["piwikUrl"] : (function () { throw new RuntimeError('Variable "piwikUrl" does not exist.', 22, $this->source); })()), "

"), "url"), "html", null, true);
                yield "\"
                       class=\"btn activateTagManagerPlugin\"><span class=\"icon-rocket\"></span> ";
                // line 23
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerEmailSuperUserToActivate"), "html", null, true);
                yield " <span class=\"icon-rocket\"></span></a>
                ";
            }
            // line 25
            yield "
                <a href=\"";
            // line 26
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFunction('linkTo')->getCallable()(["module" => "CorePluginsAdmin", "action" => "disableActivateTagManagerPage"]), "html", null, true);
            yield "\"
                   class=\"btn dontShowAgainBtn\"><span class=\"icon-hide\"></span>
                    ";
            // line 28
            if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 28, $this->source); })())) {
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerTeaserHideSuperUser"), "html", null, true);
            } else {
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerTeaserHideNonSuperUser"), "html", null, true);
            }
            // line 29
            yield "                </a>
            </div>
        </div>
    </div>
    ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 34
        yield "    ";
        yield (isset($context["actionBlock"]) || array_key_exists("actionBlock", $context) ? $context["actionBlock"] : (function () { throw new RuntimeError('Variable "actionBlock" does not exist.', 34, $this->source); })());
        yield "
    <div class=\"row\">
        <div class=\"col ";
        // line 36
        if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 36, $this->source); })())) {
            yield "l4";
        } else {
            yield "l6";
        }
        yield " m12 s12\">
            <div vue-entry=\"CoreHome.ContentBlock\" content-title=\"";
        // line 37
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhatIsTagManager"), "html", null, true);
        yield "\">
                <p>
                    ";
        // line 39
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhatIsTagManagerDetails1"), "html", null, true);
        yield "<br /><br />
                    ";
        // line 40
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhatIsTagManagerDetails2"), "html", null, true);
        yield "<br /><br />
                    <a href=\"";
        // line 41
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/docs/tag-manager"), "html", null, true);
        yield "\" rel=\"noreferrer noopener\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerLearnMoreInUserGuide"), "html", null, true);
        yield "</a>
                </p>
            </div>
        </div>
        <div class=\"col ";
        // line 45
        if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 45, $this->source); })())) {
            yield "l4";
        } else {
            yield "l6";
        }
        yield " m12 s12\">
            <div vue-entry=\"CoreHome.ContentBlock\" content-title=\"";
        // line 46
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhyUsingATagManager"), "html", null, true);
        yield "\">
                <p>
                    ";
        // line 48
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhyUsingATagManagerDetails1"), "html", null, true);
        yield "
                    <br /><br />
                    ";
        // line 50
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhyUsingATagManagerDetails2"), "html", null, true);
        yield "
                    <br /><br />
                    ";
        // line 52
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_WhyUsingATagManagerDetails3"), "html", null, true);
        yield "
                    <br /><br /><br />
                    <a href=\"";
        // line 54
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/docs/tag-manager"), "html", null, true);
        yield "\" rel=\"noreferrer noopener\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerLearnMoreInUserGuide"), "html", null, true);
        yield "</a>
                </p>
            </div>
        </div>
        ";
        // line 58
        if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 58, $this->source); })())) {
            // line 59
            yield "            <div class=\"col l4 m12 s12\">
                <div vue-entry=\"CoreHome.ContentBlock\" content-title=\"";
            // line 60
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_AreThereAnyRisks"), "html", null, true);
            yield "\">

                    ";
            // line 62
            yield $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_AreThereAnyRisksDetails1", "<a rel=\"noreferrer noopener\" href=\"https://en.wikipedia.org/wiki/Cross-site_scripting\">", "</a>");
            yield "
                    <br /><br />
                    ";
            // line 64
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_AreThereAnyRisksDetails2"), "html", null, true);
            yield "
                    <br /><br /><br />
                    <a href=\"";
            // line 66
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/faq/tag-manager/website-security-considerations-when-using-a-tag-manager/"), "html", null, true);
            yield "\" rel=\"noreferrer noopener\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("CorePluginsAdmin_TagManagerLearnMoreInUserGuide"), "html", null, true);
            yield "</a>
                </div>
            </div>
        ";
        }
        // line 70
        yield "    </div>
    ";
        // line 71
        yield (isset($context["actionBlock"]) || array_key_exists("actionBlock", $context) ? $context["actionBlock"] : (function () { throw new RuntimeError('Variable "actionBlock" does not exist.', 71, $this->source); })());
        yield "
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@CorePluginsAdmin/tagManagerTeaser.twig";
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
        return array (  240 => 71,  237 => 70,  228 => 66,  223 => 64,  218 => 62,  213 => 60,  210 => 59,  208 => 58,  199 => 54,  194 => 52,  189 => 50,  184 => 48,  179 => 46,  171 => 45,  162 => 41,  158 => 40,  154 => 39,  149 => 37,  141 => 36,  135 => 34,  127 => 29,  121 => 28,  116 => 26,  113 => 25,  108 => 23,  93 => 22,  88 => 20,  83 => 19,  81 => 18,  76 => 15,  74 => 14,  68 => 11,  64 => 10,  59 => 7,  55 => 6,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'dashboard.twig' %}

{% block topcontrols %}
{% endblock %}

{% block content %}
<div class=\"activateTagManager\">
    <div class=\"row\">
        <div class=\"col s12\" style=\"text-align: center;\">
            <h2>{{ 'CorePluginsAdmin_TagManagerNowAvailableTitle'|translate }}</h2>
            <p>{{ 'CorePluginsAdmin_TagManagerNowAvailableSubtitle'|translate }}</p>
        </div>
    </div>
    {% set actionBlock %}
    <div class=\"row\">
        <div class=\"col s12\">
            <div style=\"text-align: center;\">
                {% if isSuperUser %}
                    <a href=\"{{ linkTo({'module': 'CorePluginsAdmin', 'action': 'activate', 'nonce': nonce, 'pluginName': 'TagManager', 'redirectTo': 'tagmanager'}) }}\"
                       class=\"btn activateTagManagerPlugin\"><span class=\"icon-rocket\"></span> {{ 'CorePluginsAdmin_ActivateTagManagerNow'|translate }} <span class=\"icon-rocket\"></span></a>
                {% else %}
                    <a href=\"mailto:{{ contactEmail|e('url') }}?subject={{ 'CorePluginsAdmin_TagManagerNowAvailableTitle'|translate|e('url') }}&body={{ 'CorePluginsAdmin_TagManagerTeaserEmailSuperUserBody'|translate(\"\\n\\n\", \"\\n\\n\", piwikUrl, \"\\n\\n\")|e('url') }}\"
                       class=\"btn activateTagManagerPlugin\"><span class=\"icon-rocket\"></span> {{ 'CorePluginsAdmin_TagManagerEmailSuperUserToActivate'|translate }} <span class=\"icon-rocket\"></span></a>
                {% endif %}

                <a href=\"{{ linkTo({'module': 'CorePluginsAdmin', 'action': 'disableActivateTagManagerPage'}) }}\"
                   class=\"btn dontShowAgainBtn\"><span class=\"icon-hide\"></span>
                    {% if isSuperUser %}{{ 'CorePluginsAdmin_TagManagerTeaserHideSuperUser'|translate }}{% else %}{{ 'CorePluginsAdmin_TagManagerTeaserHideNonSuperUser'|translate }}{% endif %}
                </a>
            </div>
        </div>
    </div>
    {% endset %}
    {{ actionBlock|raw }}
    <div class=\"row\">
        <div class=\"col {% if isSuperUser %}l4{% else %}l6{% endif %} m12 s12\">
            <div vue-entry=\"CoreHome.ContentBlock\" content-title=\"{{ 'CorePluginsAdmin_WhatIsTagManager'|translate }}\">
                <p>
                    {{ 'CorePluginsAdmin_WhatIsTagManagerDetails1'|translate }}<br /><br />
                    {{ 'CorePluginsAdmin_WhatIsTagManagerDetails2'|translate }}<br /><br />
                    <a href=\"{{ 'https://matomo.org/docs/tag-manager'|trackmatomolink }}\" rel=\"noreferrer noopener\">{{ 'CorePluginsAdmin_TagManagerLearnMoreInUserGuide'|translate }}</a>
                </p>
            </div>
        </div>
        <div class=\"col {% if isSuperUser %}l4{% else %}l6{% endif %} m12 s12\">
            <div vue-entry=\"CoreHome.ContentBlock\" content-title=\"{{ 'CorePluginsAdmin_WhyUsingATagManager'|translate }}\">
                <p>
                    {{ 'CorePluginsAdmin_WhyUsingATagManagerDetails1'|translate }}
                    <br /><br />
                    {{ 'CorePluginsAdmin_WhyUsingATagManagerDetails2'|translate }}
                    <br /><br />
                    {{ 'CorePluginsAdmin_WhyUsingATagManagerDetails3'|translate }}
                    <br /><br /><br />
                    <a href=\"{{ 'https://matomo.org/docs/tag-manager'|trackmatomolink }}\" rel=\"noreferrer noopener\">{{ 'CorePluginsAdmin_TagManagerLearnMoreInUserGuide'|translate }}</a>
                </p>
            </div>
        </div>
        {% if isSuperUser %}
            <div class=\"col l4 m12 s12\">
                <div vue-entry=\"CoreHome.ContentBlock\" content-title=\"{{ 'CorePluginsAdmin_AreThereAnyRisks'|translate }}\">

                    {{ 'CorePluginsAdmin_AreThereAnyRisksDetails1'|translate('<a rel=\"noreferrer noopener\" href=\"https://en.wikipedia.org/wiki/Cross-site_scripting\">', '</a>')|raw }}
                    <br /><br />
                    {{ 'CorePluginsAdmin_AreThereAnyRisksDetails2'|translate }}
                    <br /><br /><br />
                    <a href=\"{{ 'https://matomo.org/faq/tag-manager/website-security-considerations-when-using-a-tag-manager/'|trackmatomolink }}\" rel=\"noreferrer noopener\">{{ 'CorePluginsAdmin_TagManagerLearnMoreInUserGuide'|translate }}</a>
                </div>
            </div>
        {% endif %}
    </div>
    {{ actionBlock|raw }}
</div>
{% endblock %}
", "@CorePluginsAdmin/tagManagerTeaser.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/CorePluginsAdmin/templates/tagManagerTeaser.twig");
    }
}
