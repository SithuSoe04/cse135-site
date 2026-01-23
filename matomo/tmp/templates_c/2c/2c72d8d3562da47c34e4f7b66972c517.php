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

/* @CoreHome/_dataTableFooter.twig */
class __TwigTemplate_cb4007100ad3e62387575a7c8f60b93f extends Template
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
        yield "<div class=\"dataTableFeatures\">
    <div class=\"dataTableFooterNavigation\">

        ";
        // line 4
        if (( !(isset($context["isDataTableEmpty"]) || array_key_exists("isDataTableEmpty", $context) ? $context["isDataTableEmpty"] : (function () { throw new RuntimeError('Variable "isDataTableEmpty" does not exist.', 4, $this->source); })()) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 4, $this->source); })()), "show_offset_information", [], "any", false, false, false, 4) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 4, $this->source); })()), "show_pagination_control", [], "any", false, false, false, 4)))) {
            // line 5
            yield "            <div class=\"row dataTablePaginationControl\">
                ";
            // line 6
            if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 6, $this->source); })()), "show_pagination_control", [], "any", false, false, false, 6)) {
                // line 7
                yield "                    <span class=\"dataTablePrevious\">&lsaquo; ";
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["clientSideParameters"] ?? null), "dataTablePreviousIsFirst", [], "any", true, true, false, 7)) {
                    yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_First"), "html", null, true);
                } else {
                    yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Previous"), "html", null, true);
                }
                yield "</span>
                    &nbsp;
                ";
            }
            // line 10
            yield "                ";
            if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 10, $this->source); })()), "show_offset_information", [], "any", false, false, false, 10)) {
                // line 11
                yield "                    <span class=\"dataTablePages\"></span>
                ";
            }
            // line 13
            yield "                ";
            if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 13, $this->source); })()), "show_pagination_control", [], "any", false, false, false, 13)) {
                // line 14
                yield "                    &nbsp;<span class=\"dataTableNext\">";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Next"), "html", null, true);
                yield " &rsaquo;</span>
                ";
            }
            // line 16
            yield "            </div>
        ";
        }
        // line 18
        yield "
        <div class=\"row\">
            <div class=\"col s9 m9 dataTableControls\">
                ";
        // line 21
        yield from         $this->loadTemplate("@CoreHome/_dataTableActions.twig", "@CoreHome/_dataTableFooter.twig", 21)->unwrap()->yield($context);
        // line 22
        yield "            </div>

            ";
        // line 24
        if (( !(isset($context["isDataTableEmpty"]) || array_key_exists("isDataTableEmpty", $context) ? $context["isDataTableEmpty"] : (function () { throw new RuntimeError('Variable "isDataTableEmpty" does not exist.', 24, $this->source); })()) && ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 24, $this->source); })()), "show_footer_icons", [], "any", false, false, false, 24) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 24, $this->source); })()), "show_pagination_control", [], "any", false, false, false, 24)) || CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 24, $this->source); })()), "show_limit_control", [], "any", false, false, false, 24)))) {
            // line 25
            yield "                <div class=\"col s3 m3 limitSelection\"></div>
            ";
        }
        // line 27
        yield "        </div>

        ";
        // line 29
        if (( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 29, $this->source); })()), "related_reports", [], "any", false, false, false, 29)) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 29, $this->source); })()), "show_related_reports", [], "any", false, false, false, 29))) {
            // line 30
            yield "            <div class=\"row datatableRelatedReports\">
                ";
            // line 31
            yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 31, $this->source); })()), "related_reports_title", [], "any", false, false, false, 31);
            yield "
                <ul style=\"list-style:none;";
            // line 32
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 32, $this->source); })()), "related_reports", [], "any", false, false, false, 32)) == 1)) {
                yield "display:inline-block;";
            }
            yield "\">
                    <li><span href=\"";
            // line 33
            yield \Piwik\piwik_escape_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 33, $this->source); })()), "self_url", [], "any", false, false, false, 33), "html", null, true);
            yield "\" style=\"display:none;\">";
            yield \Piwik\piwik_escape_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 33, $this->source); })()), "title", [], "any", false, false, false, 33), "html", null, true);
            yield "</span></li>

                    ";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 35, $this->source); })()), "related_reports", [], "any", false, false, false, 35));
            foreach ($context['_seq'] as $context["reportUrl"] => $context["reportTitle"]) {
                // line 36
                yield "                        <li><span href=\"";
                yield \Piwik\piwik_escape_filter($this->env, $context["reportUrl"], "html", null, true);
                yield "\">";
                yield \Piwik\piwik_escape_filter($this->env, $context["reportTitle"], "html", null, true);
                yield "</span></li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['reportUrl'], $context['reportTitle'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            yield "                </ul>
            </div>
        ";
        }
        // line 41
        yield "    </div>

    <span class=\"loadingPiwik\" style=\"display:none;\">
        ";
        // line 44
        yield from         $this->loadTemplate("@CoreHome/_loader.twig", "@CoreHome/_dataTableFooter.twig", 44)->unwrap()->yield($context);
        // line 45
        yield "        ";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_LoadingData"), "html", null, true);
        yield "
    </span>

    ";
        // line 48
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["properties"] ?? null), "show_footer_message", [], "any", true, true, false, 48) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 48, $this->source); })()), "show_footer_message", [], "any", false, false, false, 48)))) {
            // line 49
            yield "        <div class='datatableFooterMessage'>";
            yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 49, $this->source); })()), "show_footer_message", [], "any", false, false, false, 49);
            yield "</div>
    ";
        }
        // line 51
        yield "
</div>

<span class=\"loadingPiwikBelow\" style=\"display:none;\">
    ";
        // line 55
        yield from         $this->loadTemplate("@CoreHome/_loader.twig", "@CoreHome/_dataTableFooter.twig", 55)->unwrap()->yield($context);
        // line 56
        yield "    ";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_LoadingData"), "html", null, true);
        yield "
</span>

<div class=\"dataTableSpacer\"></div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@CoreHome/_dataTableFooter.twig";
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
        return array (  174 => 56,  172 => 55,  166 => 51,  160 => 49,  158 => 48,  151 => 45,  149 => 44,  144 => 41,  139 => 38,  128 => 36,  124 => 35,  117 => 33,  111 => 32,  107 => 31,  104 => 30,  102 => 29,  98 => 27,  94 => 25,  92 => 24,  88 => 22,  86 => 21,  81 => 18,  77 => 16,  71 => 14,  68 => 13,  64 => 11,  61 => 10,  50 => 7,  48 => 6,  45 => 5,  43 => 4,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"dataTableFeatures\">
    <div class=\"dataTableFooterNavigation\">

        {% if not isDataTableEmpty and (properties.show_offset_information or properties.show_pagination_control) %}
            <div class=\"row dataTablePaginationControl\">
                {% if properties.show_pagination_control %}
                    <span class=\"dataTablePrevious\">&lsaquo; {% if clientSideParameters.dataTablePreviousIsFirst is defined %}{{ 'General_First'|translate }}{% else %}{{ 'General_Previous'|translate }}{% endif %}</span>
                    &nbsp;
                {% endif %}
                {% if properties.show_offset_information %}
                    <span class=\"dataTablePages\"></span>
                {% endif %}
                {% if properties.show_pagination_control %}
                    &nbsp;<span class=\"dataTableNext\">{{ 'General_Next'|translate }} &rsaquo;</span>
                {% endif %}
            </div>
        {% endif %}

        <div class=\"row\">
            <div class=\"col s9 m9 dataTableControls\">
                {% include \"@CoreHome/_dataTableActions.twig\" %}
            </div>

            {% if not isDataTableEmpty and (properties.show_footer_icons and properties.show_pagination_control or properties.show_limit_control) %}
                <div class=\"col s3 m3 limitSelection\"></div>
            {% endif %}
        </div>

        {% if (properties.related_reports is not empty) and properties.show_related_reports %}
            <div class=\"row datatableRelatedReports\">
                {{ properties.related_reports_title|raw }}
                <ul style=\"list-style:none;{% if properties.related_reports|length == 1 %}display:inline-block;{% endif %}\">
                    <li><span href=\"{{ properties.self_url }}\" style=\"display:none;\">{{ properties.title }}</span></li>

                    {% for reportUrl,reportTitle in properties.related_reports %}
                        <li><span href=\"{{ reportUrl }}\">{{ reportTitle }}</span></li>
                    {% endfor %}
                </ul>
            </div>
        {% endif %}
    </div>

    <span class=\"loadingPiwik\" style=\"display:none;\">
        {% include \"@CoreHome/_loader.twig\" %}
        {{ 'General_LoadingData'|translate }}
    </span>

    {% if properties.show_footer_message is defined and properties.show_footer_message is not empty %}
        <div class='datatableFooterMessage'>{{ properties.show_footer_message | raw }}</div>
    {% endif %}

</div>

<span class=\"loadingPiwikBelow\" style=\"display:none;\">
    {% include \"@CoreHome/_loader.twig\" %}
    {{ 'General_LoadingData'|translate }}
</span>

<div class=\"dataTableSpacer\"></div>
", "@CoreHome/_dataTableFooter.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/CoreHome/templates/_dataTableFooter.twig");
    }
}
