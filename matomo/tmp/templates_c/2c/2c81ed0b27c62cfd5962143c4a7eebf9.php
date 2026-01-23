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

/* @SegmentEditor/_segmentSelector.twig */
class __TwigTemplate_346d12b9f349e8f6531e685314a06b7c extends Template
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
        yield "<div class=\"SegmentEditor\" style=\"display:none;\">
    <div class=\"segmentationContainer listHtml\">
        <a class=\"title\" tabindex=\"4\" title=\"";
        // line 3
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_ChooseASegment"), "html", null, true);
        yield ". ";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_CurrentlySelectedSegment", (isset($context["segmentDescription"]) || array_key_exists("segmentDescription", $context) ? $context["segmentDescription"] : (function () { throw new RuntimeError('Variable "segmentDescription" does not exist.', 3, $this->source); })())), "html", null, true);
        yield "\">
            <span class=\"icon icon-segment\"></span><span class=\"segmentationTitle\"></span>
        </a>
        <div class=\"dropdown dropdown-body\">
            <div class=\"segmentFilterContainer\">
                <input class=\"segmentFilter browser-default\" type=\"text\" tabindex=\"4\" value=\"";
        // line 8
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Search"), "html", null, true);
        yield "\"/>
                <span></span>
            </div>
            <ul class=\"submenu\">
                <li>";
        // line 12
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_SelectSegmentOfVisits"), "html", null, true);
        yield "
                    <div class=\"segmentList\">
                        <ul>
                        </ul>
                    </div>
                </li>
            </ul>

            ";
        // line 20
        if ((isset($context["authorizedToCreateSegments"]) || array_key_exists("authorizedToCreateSegments", $context) ? $context["authorizedToCreateSegments"] : (function () { throw new RuntimeError('Variable "authorizedToCreateSegments" does not exist.', 20, $this->source); })())) {
            // line 21
            yield "                <a tabindex=\"4\" class=\"add_new_segment btn\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_AddNewSegment"), "html", null, true);
            yield "</a>
            ";
        } else {
            // line 23
            yield "                <hr/>
                <ul class=\"submenu\">
                <li>
                    ";
            // line 26
            if ((isset($context["isUserAnonymous"]) || array_key_exists("isUserAnonymous", $context) ? $context["isUserAnonymous"] : (function () { throw new RuntimeError('Variable "isUserAnonymous" does not exist.', 26, $this->source); })())) {
                // line 27
                yield "                        <span class='youMustBeLoggedIn'>";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_YouMustBeLoggedInToCreateSegments"), "html", null, true);
                yield "
                        <br/>&rsaquo; <a href='index.php?module=";
                // line 28
                yield \Piwik\piwik_escape_filter($this->env, (isset($context["loginModule"]) || array_key_exists("loginModule", $context) ? $context["loginModule"] : (function () { throw new RuntimeError('Variable "loginModule" does not exist.', 28, $this->source); })()), "html", null, true);
                yield "'>";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LogIn"), "html", null, true);
                yield "</a> </span>
                    ";
            }
            // line 30
            yield "                </li>
                </ul>
                <br/><br/>
            ";
        }
        // line 34
        yield "        </div>
    </div>

    <div class=\"segment-element borderedControl expanded\">

        <div class=\"segment-content\">
            <div class=\"segment-top\" ";
        // line 40
        if ( !(isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 40, $this->source); })())) {
            yield "style=\"display:none\"";
        }
        yield ">
               <input type=\"hidden\" class=\"available_segments_select\"/>
               <div class=\"segment-top-item grid-1\">
                ";
        // line 43
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_ThisSegmentIsVisibleTo"), "html", null, true);
        yield " <div class=\"enable_all_users\"><strong>
                        <select class=\"enable_all_users_select\">
                            <option ";
        // line 45
        if ( !(isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 45, $this->source); })())) {
            yield "selected=\"1\"";
        }
        yield " value=\"0\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_VisibleToMe"), "html", null, true);
        yield "</option>
                            <option ";
        // line 46
        if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 46, $this->source); })())) {
            yield "selected=\"1\"";
        }
        yield " value=\"1\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_VisibleToAllUsers"), "html", null, true);
        yield "</option>
                        </select>
                    </strong></div>
                </div>
                <div class=\"segment-top-item grid-2\">
                ";
        // line 51
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_SegmentIsDisplayedForWebsite"), "html", null, true);
        yield "<div class=\"visible_to_website\"><strong>
                        <select class=\"visible_to_website_select\">
                            <option selected=\"\" value=\"";
        // line 53
        yield \Piwik\piwik_escape_filter($this->env, (isset($context["idSite"]) || array_key_exists("idSite", $context) ? $context["idSite"] : (function () { throw new RuntimeError('Variable "idSite" does not exist.', 53, $this->source); })()), "html", null, true);
        yield "\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_SegmentDisplayedThisWebsiteOnly"), "html", null, true);
        yield "</option>
                            ";
        // line 54
        if ((isset($context["isAddingSegmentsForAllWebsitesEnabled"]) || array_key_exists("isAddingSegmentsForAllWebsitesEnabled", $context) ? $context["isAddingSegmentsForAllWebsitesEnabled"] : (function () { throw new RuntimeError('Variable "isAddingSegmentsForAllWebsitesEnabled" does not exist.', 54, $this->source); })())) {
            yield "<option value=\"0\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_SegmentDisplayedAllWebsites"), "html", null, true);
            yield "</option>";
        }
        // line 55
        yield "                        </select>
                    </strong></div>
                </div>
                ";
        // line 58
        if ((isset($context["isCreateRealtimeSegmentsEnabled"]) || array_key_exists("isCreateRealtimeSegmentsEnabled", $context) ? $context["isCreateRealtimeSegmentsEnabled"] : (function () { throw new RuntimeError('Variable "isCreateRealtimeSegmentsEnabled" does not exist.', 58, $this->source); })())) {
            // line 59
            yield "                   <div class=\"segment-top-item grid-3\">
                    ";
            // line 60
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_And"), "html", null, true);
            yield "
                    <div class=\"auto_archive\"><strong>
                            <select class=\"auto_archive_select\">
                                ";
            // line 63
            if ((isset($context["createRealTimeSegmentsIsEnabled"]) || array_key_exists("createRealTimeSegmentsIsEnabled", $context) ? $context["createRealTimeSegmentsIsEnabled"] : (function () { throw new RuntimeError('Variable "createRealTimeSegmentsIsEnabled" does not exist.', 63, $this->source); })())) {
                // line 64
                yield "                                    <option ";
                if ((isset($context["isBrowserArchivingEnabled"]) || array_key_exists("isBrowserArchivingEnabled", $context) ? $context["isBrowserArchivingEnabled"] : (function () { throw new RuntimeError('Variable "isBrowserArchivingEnabled" does not exist.', 64, $this->source); })())) {
                    yield "selected=\"1\"";
                }
                yield " value=\"0\">";
                yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_AutoArchiveRealTime"), "html", null, true);
                yield "</option>
                                ";
            }
            // line 66
            yield "                                <option ";
            if (( !(isset($context["isBrowserArchivingEnabled"]) || array_key_exists("isBrowserArchivingEnabled", $context) ? $context["isBrowserArchivingEnabled"] : (function () { throw new RuntimeError('Variable "isBrowserArchivingEnabled" does not exist.', 66, $this->source); })()) ||  !(isset($context["createRealTimeSegmentsIsEnabled"]) || array_key_exists("createRealTimeSegmentsIsEnabled", $context) ? $context["createRealTimeSegmentsIsEnabled"] : (function () { throw new RuntimeError('Variable "createRealTimeSegmentsIsEnabled" does not exist.', 66, $this->source); })()))) {
                yield "selected=\"1\"";
            }
            yield " value=\"1\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_AutoArchivePreProcessed"), "html", null, true);
            yield " </option>
                            </select>
                        </strong>
                    </div>
                   </div>
                ";
        }
        // line 72
        yield "
            </div>
            <h3 style=\"margin: 12px 6px;\">";
        // line 74
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Name"), "html", null, true);
        yield ": <span  class=\"segmentName\"></span> <a class=\"editSegmentName\" href=\"#\">";
        yield \Piwik\piwik_escape_filter($this->env, Twig\Extension\CoreExtension::lower($this->env->getCharset(), $this->env->getFilter('translate')->getCallable()("General_Edit")), "html", null, true);
        yield "</a></h3>
        </div>
        <div class=\"segment-footer\">
            <div vue-entry=\"Feedback.RateFeature\" title=\"&quot;";
        // line 77
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_SegmentEditor"), "html", null, true);
        yield "&quot;\" style=\"display:inline-block;float: left;margin-top: 2px;margin-right: 10px;\"></div>
            <a class=\"btn-flat delete\" href=\"#\">";
        // line 78
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Delete"), "html", null, true);
        yield "</a>
            <a class=\"btn-flat close\" href=\"#\">";
        // line 79
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Close"), "html", null, true);
        yield "</a>
            ";
        // line 80
        if ((isset($context["isVisitorLogEnabled"]) || array_key_exists("isVisitorLogEnabled", $context) ? $context["isVisitorLogEnabled"] : (function () { throw new RuntimeError('Variable "isVisitorLogEnabled" does not exist.', 80, $this->source); })())) {
            // line 81
            yield "                <a class=\"btn-flat testSegment\">";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_Test"), "html", null, true);
            yield "</a>
            ";
        }
        // line 83
        yield "            <button class=\"btn saveAndApply\">";
        yield $this->env->getFilter('translate')->getCallable()("SegmentEditor_SaveAndApply");
        yield "</button>
        </div>
    </div>
</div>
<div class=\"segmentListContainer\">
<div class=\"ui-confirm\" id=\"segment-delete-confirm\">
    <h2>";
        // line 89
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_AreYouSureDeleteSegment"), "html", null, true);
        yield "</h2>
    <input role=\"yes\" type=\"button\" value=\"";
        // line 90
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Yes"), "html", null, true);
        yield "\"/>
    <input role=\"no\" type=\"button\" value=\"";
        // line 91
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_No"), "html", null, true);
        yield "\"/>
</div>
<div class=\"ui-confirm segment-definition-change-confirm\" data-segment-processed-on-request=\"";
        // line 93
        yield \Piwik\piwik_escape_filter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["segmentProcessedOnRequest"]) || array_key_exists("segmentProcessedOnRequest", $context) ? $context["segmentProcessedOnRequest"] : (function () { throw new RuntimeError('Variable "segmentProcessedOnRequest" does not exist.', 93, $this->source); })())), "html", null, true);
        yield "\" data-hide-message=\"";
        yield \Piwik\piwik_escape_filter($this->env, (isset($context["hideSegmentDefinitionChangeMessage"]) || array_key_exists("hideSegmentDefinitionChangeMessage", $context) ? $context["hideSegmentDefinitionChangeMessage"] : (function () { throw new RuntimeError('Variable "hideSegmentDefinitionChangeMessage" does not exist.', 93, $this->source); })()), "html", null, true);
        yield "\">
    <h2>
        <span class=\"process-on-request\">
            ";
        // line 96
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_ChangingSegmentDefinitionConfirmationProcessedOnRequest"), "html", null, true);
        yield "
        </span>
        <span class=\"no-process-on-request\">
            ";
        // line 99
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_ChangingSegmentDefinitionConfirmationNotProcessedOnRequest"), "html", null, true);
        yield "
        </span>
    </h2>
    <p class=\"description\">
        <span>
            <label>
                <input type=\"checkbox\" id=\"hideSegmentMessage\" name=\"hideSegmentMessage\" />
                <span>";
        // line 106
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_HideMessageInFuture"), "html", null, true);
        yield "</span>
            </label>
        </span>
    </p>
    <input role=\"yes\" type=\"button\" value=\"";
        // line 110
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Yes"), "html", null, true);
        yield "\"/>
    <input role=\"no\" type=\"button\" value=\"";
        // line 111
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_No"), "html", null, true);
        yield "\"/>
</div>
<div class=\"ui-confirm pleaseChangeBrowserAchivingDisabledSetting\">
    <h2>";
        // line 114
        yield $this->env->getFilter('rawSafeDecoded')->getCallable()($this->env->getFilter('translate')->getCallable()("SegmentEditor_SegmentNotApplied", (isset($context["nameOfCurrentSegment"]) || array_key_exists("nameOfCurrentSegment", $context) ? $context["nameOfCurrentSegment"] : (function () { throw new RuntimeError('Variable "nameOfCurrentSegment" does not exist.', 114, $this->source); })())));
        yield "</h2>
    ";
        // line 115
        $context["segmentSetting"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_AutoArchivePreProcessed"), "html", null, true);
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 116
        yield "    <p class=\"description\">
        ";
        // line 117
        yield $this->env->getFilter('rawSafeDecoded')->getCallable()($this->env->getFilter('translate')->getCallable()("SegmentEditor_SegmentNotAppliedMessage", (isset($context["nameOfCurrentSegment"]) || array_key_exists("nameOfCurrentSegment", $context) ? $context["nameOfCurrentSegment"] : (function () { throw new RuntimeError('Variable "nameOfCurrentSegment" does not exist.', 117, $this->source); })())));
        yield "
        <br/>
        ";
        // line 119
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_DataAvailableAtLaterDate"), "html", null, true);
        yield "
        ";
        // line 120
        if ((isset($context["isSuperUser"]) || array_key_exists("isSuperUser", $context) ? $context["isSuperUser"] : (function () { throw new RuntimeError('Variable "isSuperUser" does not exist.', 120, $this->source); })())) {
            // line 121
            yield "            <br/> <br/> ";
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("SegmentEditor_YouMayChangeSetting", "browser_archiving_disabled_enforce", (isset($context["segmentSetting"]) || array_key_exists("segmentSetting", $context) ? $context["segmentSetting"] : (function () { throw new RuntimeError('Variable "segmentSetting" does not exist.', 121, $this->source); })())), "html", null, true);
            yield "
        ";
        }
        // line 123
        yield "    </p>

    <input role=\"yes\" type=\"button\" value=\"";
        // line 125
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Ok"), "html", null, true);
        yield "\"/>
</div>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@SegmentEditor/_segmentSelector.twig";
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
        return array (  332 => 125,  328 => 123,  322 => 121,  320 => 120,  316 => 119,  311 => 117,  308 => 116,  303 => 115,  299 => 114,  293 => 111,  289 => 110,  282 => 106,  272 => 99,  266 => 96,  258 => 93,  253 => 91,  249 => 90,  245 => 89,  235 => 83,  229 => 81,  227 => 80,  223 => 79,  219 => 78,  215 => 77,  207 => 74,  203 => 72,  189 => 66,  179 => 64,  177 => 63,  171 => 60,  168 => 59,  166 => 58,  161 => 55,  155 => 54,  149 => 53,  144 => 51,  132 => 46,  124 => 45,  119 => 43,  111 => 40,  103 => 34,  97 => 30,  90 => 28,  85 => 27,  83 => 26,  78 => 23,  72 => 21,  70 => 20,  59 => 12,  52 => 8,  42 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"SegmentEditor\" style=\"display:none;\">
    <div class=\"segmentationContainer listHtml\">
        <a class=\"title\" tabindex=\"4\" title=\"{{ 'SegmentEditor_ChooseASegment'|translate }}. {{ 'SegmentEditor_CurrentlySelectedSegment'|translate(segmentDescription) }}\">
            <span class=\"icon icon-segment\"></span><span class=\"segmentationTitle\"></span>
        </a>
        <div class=\"dropdown dropdown-body\">
            <div class=\"segmentFilterContainer\">
                <input class=\"segmentFilter browser-default\" type=\"text\" tabindex=\"4\" value=\"{{ 'General_Search'|translate }}\"/>
                <span></span>
            </div>
            <ul class=\"submenu\">
                <li>{{ 'SegmentEditor_SelectSegmentOfVisits'|translate }}
                    <div class=\"segmentList\">
                        <ul>
                        </ul>
                    </div>
                </li>
            </ul>

            {% if authorizedToCreateSegments %}
                <a tabindex=\"4\" class=\"add_new_segment btn\">{{ 'SegmentEditor_AddNewSegment'|translate }}</a>
            {% else %}
                <hr/>
                <ul class=\"submenu\">
                <li>
                    {% if isUserAnonymous %}
                        <span class='youMustBeLoggedIn'>{{ 'SegmentEditor_YouMustBeLoggedInToCreateSegments'|translate }}
                        <br/>&rsaquo; <a href='index.php?module={{ loginModule }}'>{{ 'Login_LogIn'|translate }}</a> </span>
                    {% endif %}
                </li>
                </ul>
                <br/><br/>
            {% endif %}
        </div>
    </div>

    <div class=\"segment-element borderedControl expanded\">

        <div class=\"segment-content\">
            <div class=\"segment-top\" {% if not isSuperUser %}style=\"display:none\"{% endif %}>
               <input type=\"hidden\" class=\"available_segments_select\"/>
               <div class=\"segment-top-item grid-1\">
                {{ 'SegmentEditor_ThisSegmentIsVisibleTo'|translate }} <div class=\"enable_all_users\"><strong>
                        <select class=\"enable_all_users_select\">
                            <option {% if not isSuperUser %}selected=\"1\"{% endif %} value=\"0\">{{ 'SegmentEditor_VisibleToMe'|translate }}</option>
                            <option {% if isSuperUser %}selected=\"1\"{% endif %} value=\"1\">{{ 'SegmentEditor_VisibleToAllUsers'|translate }}</option>
                        </select>
                    </strong></div>
                </div>
                <div class=\"segment-top-item grid-2\">
                {{ 'SegmentEditor_SegmentIsDisplayedForWebsite'|translate }}<div class=\"visible_to_website\"><strong>
                        <select class=\"visible_to_website_select\">
                            <option selected=\"\" value=\"{{ idSite }}\">{{ 'SegmentEditor_SegmentDisplayedThisWebsiteOnly'|translate }}</option>
                            {% if isAddingSegmentsForAllWebsitesEnabled %}<option value=\"0\">{{ 'SegmentEditor_SegmentDisplayedAllWebsites'|translate }}</option>{% endif %}
                        </select>
                    </strong></div>
                </div>
                {% if isCreateRealtimeSegmentsEnabled %}
                   <div class=\"segment-top-item grid-3\">
                    {{ 'General_And'|translate }}
                    <div class=\"auto_archive\"><strong>
                            <select class=\"auto_archive_select\">
                                {% if createRealTimeSegmentsIsEnabled %}
                                    <option {% if isBrowserArchivingEnabled %}selected=\"1\"{% endif%} value=\"0\">{{ 'SegmentEditor_AutoArchiveRealTime'|translate }}</option>
                                {% endif %}
                                <option {% if not isBrowserArchivingEnabled or not createRealTimeSegmentsIsEnabled %}selected=\"1\"{% endif %} value=\"1\">{{ 'SegmentEditor_AutoArchivePreProcessed'|translate }} </option>
                            </select>
                        </strong>
                    </div>
                   </div>
                {% endif %}

            </div>
            <h3 style=\"margin: 12px 6px;\">{{ 'General_Name'|translate }}: <span  class=\"segmentName\"></span> <a class=\"editSegmentName\" href=\"#\">{{ 'General_Edit'|translate|lower }}</a></h3>
        </div>
        <div class=\"segment-footer\">
            <div vue-entry=\"Feedback.RateFeature\" title=\"&quot;{{ 'SegmentEditor_SegmentEditor'|translate }}&quot;\" style=\"display:inline-block;float: left;margin-top: 2px;margin-right: 10px;\"></div>
            <a class=\"btn-flat delete\" href=\"#\">{{ 'General_Delete'|translate }}</a>
            <a class=\"btn-flat close\" href=\"#\">{{ 'General_Close'|translate }}</a>
            {% if isVisitorLogEnabled %}
                <a class=\"btn-flat testSegment\">{{ 'SegmentEditor_Test'|translate }}</a>
            {% endif %}
            <button class=\"btn saveAndApply\">{{ 'SegmentEditor_SaveAndApply'|translate|raw }}</button>
        </div>
    </div>
</div>
<div class=\"segmentListContainer\">
<div class=\"ui-confirm\" id=\"segment-delete-confirm\">
    <h2>{{ 'SegmentEditor_AreYouSureDeleteSegment'|translate }}</h2>
    <input role=\"yes\" type=\"button\" value=\"{{ 'General_Yes'|translate }}\"/>
    <input role=\"no\" type=\"button\" value=\"{{ 'General_No'|translate }}\"/>
</div>
<div class=\"ui-confirm segment-definition-change-confirm\" data-segment-processed-on-request=\"{{ segmentProcessedOnRequest|number_format }}\" data-hide-message=\"{{ hideSegmentDefinitionChangeMessage }}\">
    <h2>
        <span class=\"process-on-request\">
            {{ 'SegmentEditor_ChangingSegmentDefinitionConfirmationProcessedOnRequest'|translate }}
        </span>
        <span class=\"no-process-on-request\">
            {{ 'SegmentEditor_ChangingSegmentDefinitionConfirmationNotProcessedOnRequest'|translate }}
        </span>
    </h2>
    <p class=\"description\">
        <span>
            <label>
                <input type=\"checkbox\" id=\"hideSegmentMessage\" name=\"hideSegmentMessage\" />
                <span>{{ 'SegmentEditor_HideMessageInFuture'|translate }}</span>
            </label>
        </span>
    </p>
    <input role=\"yes\" type=\"button\" value=\"{{ 'General_Yes'|translate }}\"/>
    <input role=\"no\" type=\"button\" value=\"{{ 'General_No'|translate }}\"/>
</div>
<div class=\"ui-confirm pleaseChangeBrowserAchivingDisabledSetting\">
    <h2>{{ 'SegmentEditor_SegmentNotApplied'|translate(nameOfCurrentSegment)|rawSafeDecoded|raw }}</h2>
    {% set segmentSetting %}{{ 'SegmentEditor_AutoArchivePreProcessed'|translate }}{% endset %}
    <p class=\"description\">
        {{ 'SegmentEditor_SegmentNotAppliedMessage'|translate(nameOfCurrentSegment)|rawSafeDecoded|raw }}
        <br/>
        {{ 'SegmentEditor_DataAvailableAtLaterDate'|translate }}
        {% if isSuperUser %}
            <br/> <br/> {{ 'SegmentEditor_YouMayChangeSetting'|translate('browser_archiving_disabled_enforce', segmentSetting) }}
        {% endif %}
    </p>

    <input role=\"yes\" type=\"button\" value=\"{{ 'General_Ok'|translate }}\"/>
</div>
</div>
", "@SegmentEditor/_segmentSelector.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/SegmentEditor/templates/_segmentSelector.twig");
    }
}
