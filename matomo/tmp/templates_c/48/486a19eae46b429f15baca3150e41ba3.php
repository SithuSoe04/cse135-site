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

/* @Login/login.twig */
class __TwigTemplate_9854e990fbe3187bebd5cb7b5916a0a5 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'loginContent' => [$this, 'block_loginContent'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return "@Login/loginLayout.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@Login/loginLayout.twig", "@Login/login.twig", 2);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_loginContent($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        yield "    <div class=\"contentForm loginForm\">
        ";
        // line 6
        yield from         $this->loadTemplate("@Login/login.twig", "@Login/login.twig", 6, "255737447")->unwrap()->yield(CoreExtension::merge($context, ["title" => $this->env->getFilter('translate')->getCallable()("Login_LogIn")]));
        // line 90
        yield "    </div>
    <div class=\"contentForm resetForm\" style=\"display:none;\">
        ";
        // line 92
        yield from         $this->loadTemplate("@Login/login.twig", "@Login/login.twig", 92, "1987587998")->unwrap()->yield(CoreExtension::merge($context, ["title" => $this->env->getFilter('translate')->getCallable()("Login_ChangeYourPassword")]));
        // line 157
        yield "    </div>

";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@Login/login.twig";
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
        return array (  62 => 157,  60 => 92,  56 => 90,  54 => 6,  51 => 5,  47 => 4,  36 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("
{% extends '@Login/loginLayout.twig' %}

{% block loginContent %}
    <div class=\"contentForm loginForm\">
        {% embed 'contentBlock.twig' with {'title': 'Login_LogIn'|translate} %}
            {% block content %}
                <div class=\"message_container\">

                    {{ include('@Login/_formErrors.twig', {formErrors: form_data.errors } )  }}

                    {% if AccessErrorString %}
                        <div vue-entry=\"CoreHome.Notification\"
                             noclear=\"true\"
                             context=\"error\">
                            <strong>{{ 'General_Error'|translate }}</strong>: {{ AccessErrorString|raw }}<br/>
                        </div>
                    {% endif %}

                    {% if infoMessage %}
                        <div class=\"alert alert-info\">{{ infoMessage|raw }}</div>
                    {% endif %}
                </div>
                <form {{ form_data.attributes|raw }}>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"text\" name=\"form_login\" id=\"login_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   placeholder=\"\" autocomplete=\"username\" autocorrect=\"off\" autocapitalize=\"none\"
                                   spellcheck=\"false\" tabindex=\"10\" autofocus=\"autofocus\" />
                            <label for=\"login_form_login\">
                                <i class=\"icon-user icon\"></i> {{ 'Login_LoginOrEmail'|translate }}
                            </label>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"login_form_nonce\" value=\"{{ nonce }}\"/>
                            <input type=\"hidden\" name=\"form_redirect\" id=\"login_form_redirect\" value=\"\"/>
                            <input type=\"password\" name=\"form_password\" id=\"login_form_password\" class=\"input\"
                                   value=\"\" size=\"20\" placeholder=\"\" autocomplete=\"current-password\" autocorrect=\"off\"
                                   autocapitalize=\"none\" spellcheck=\"false\" tabindex=\"20\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <label for=\"login_form_password\">
                                <i class=\"icon-locked icon\"></i> {{ 'General_Password'|translate }}
                            </label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s6\">
                            <label>
                                <input name=\"form_rememberme\" type=\"checkbox\" id=\"login_form_rememberme\" value=\"1\"
                                       tabindex=\"90\"
                                       {% if form_data.form_rememberme.value %}checked=\"checked\" {% endif %}/>
                                <span>{{ 'Login_RememberMe'|translate }}</span>
                            </label>
                        </div>
                        <div class=\"col s6 right-align\">
                            <a id=\"login_form_nav\" href=\"#\" tabindex=\"95\"
                               title=\"{{ 'Login_LostYourPassword'|translate }}\">
                                {{ 'Login_LostYourPassword'|translate }}
                            </a>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id=\"login_form_submit\" type=\"submit\"
                                   value=\"{{ 'Login_LogIn'|translate }}\" tabindex=\"100\" disabled=\"disabled\"
                            />
                        </div>
                    </div>
                </form>

                <div class=\"row\">
                    <div class=\"col s12\">
                        {{ postEvent(\"Template.loginNav\", \"top\") }}
                        {{ postEvent(\"Template.loginNav\", \"bottom\") }}
                    </div>
                </div>

                {% if isCustomLogo %}
                    <p id=\"piwik\">
                        <i><a href=\"{{ 'https://matomo.org/'|trackmatomolink }}\" rel=\"noreferrer noopener\" target=\"_blank\">{{ linkTitle }}</a></i>
                    </p>
                {% endif %}

            {% endblock %}
        {% endembed %}
    </div>
    <div class=\"contentForm resetForm\" style=\"display:none;\">
        {% embed 'contentBlock.twig' with {'title': 'Login_ChangeYourPassword'|translate} %}
            {% block content %}

                <div class=\"message_container\">
                </div>

                <form id=\"reset_form\" method=\"post\">
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"reset_form_nonce\" value=\"{{ nonce }}\"/>
                            <input type=\"text\" placeholder=\"\" name=\"form_login\" id=\"reset_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\"
                                   tabindex=\"10\"/>
                            <label for=\"reset_form_login\"><i class=\"icon-user icon\"></i> {{ 'Login_LoginOrEmail'|translate }}</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password\" id=\"reset_form_password\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   tabindex=\"20\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password\"
                                 validation-rules=\"{{ passwordStrengthValidationRules|json_encode }}\"
                            ></div>
                            <label for=\"reset_form_password\"><i class=\"icon-locked icon\"></i> {{ 'Login_NewPassword'|translate }}</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password_bis\" id=\"reset_form_password_bis\" class=\"input\" value=\"\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   size=\"20\" tabindex=\"30\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password_bis\"
                                 validation-rules=\"{{ passwordStrengthValidationRules|json_encode }}\"
                            ></div>
                            <label for=\"reset_form_password_bis\"><i class=\"icon-locked icon\"></i> {{ 'Login_NewPasswordRepeat'|translate }}</label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id='reset_form_submit' type=\"submit\"
                                   value=\"{{ 'General_ChangePassword'|translate }}\" tabindex=\"100\"/>

                            <span class=\"loadingPiwik\" style=\"display:none;\">
                                {% include \"@CoreHome/_loader.twig\" %}
                            </span>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"module\" value=\"{{ loginModule }}\"/>
                    <input type=\"hidden\" name=\"action\" value=\"resetPassword\"/>
                </form>
                <p id=\"nav\">
                    <a id=\"reset_form_nav\" href=\"#\"
                       title=\"{{ 'Mobile_NavigationBack'|translate }}\">{{ 'General_Cancel'|translate }}</a>
                    <a id=\"alternate_reset_nav\" href=\"#\" style=\"display:none;\"
                       title=\"{{'Login_LogIn'|translate}}\">{{ 'Login_LogIn'|translate }}</a>
                </p>
            {% endblock %}
        {% endembed %}
    </div>

{% endblock %}
", "@Login/login.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/Login/templates/login.twig");
    }
}


/* @Login/login.twig */
class __TwigTemplate_9854e990fbe3187bebd5cb7b5916a0a5___255737447 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 6
        return "contentBlock.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("contentBlock.twig", "@Login/login.twig", 6);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        yield "                <div class=\"message_container\">

                    ";
        // line 10
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@Login/_formErrors.twig", ["formErrors" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["form_data"]) || array_key_exists("form_data", $context) ? $context["form_data"] : (function () { throw new RuntimeError('Variable "form_data" does not exist.', 10, $this->source); })()), "errors", [], "any", false, false, false, 10)]);
        yield "

                    ";
        // line 12
        if ((isset($context["AccessErrorString"]) || array_key_exists("AccessErrorString", $context) ? $context["AccessErrorString"] : (function () { throw new RuntimeError('Variable "AccessErrorString" does not exist.', 12, $this->source); })())) {
            // line 13
            yield "                        <div vue-entry=\"CoreHome.Notification\"
                             noclear=\"true\"
                             context=\"error\">
                            <strong>";
            // line 16
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Error"), "html", null, true);
            yield "</strong>: ";
            yield (isset($context["AccessErrorString"]) || array_key_exists("AccessErrorString", $context) ? $context["AccessErrorString"] : (function () { throw new RuntimeError('Variable "AccessErrorString" does not exist.', 16, $this->source); })());
            yield "<br/>
                        </div>
                    ";
        }
        // line 19
        yield "
                    ";
        // line 20
        if ((isset($context["infoMessage"]) || array_key_exists("infoMessage", $context) ? $context["infoMessage"] : (function () { throw new RuntimeError('Variable "infoMessage" does not exist.', 20, $this->source); })())) {
            // line 21
            yield "                        <div class=\"alert alert-info\">";
            yield (isset($context["infoMessage"]) || array_key_exists("infoMessage", $context) ? $context["infoMessage"] : (function () { throw new RuntimeError('Variable "infoMessage" does not exist.', 21, $this->source); })());
            yield "</div>
                    ";
        }
        // line 23
        yield "                </div>
                <form ";
        // line 24
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["form_data"]) || array_key_exists("form_data", $context) ? $context["form_data"] : (function () { throw new RuntimeError('Variable "form_data" does not exist.', 24, $this->source); })()), "attributes", [], "any", false, false, false, 24);
        yield ">
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"text\" name=\"form_login\" id=\"login_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   placeholder=\"\" autocomplete=\"username\" autocorrect=\"off\" autocapitalize=\"none\"
                                   spellcheck=\"false\" tabindex=\"10\" autofocus=\"autofocus\" />
                            <label for=\"login_form_login\">
                                <i class=\"icon-user icon\"></i> ";
        // line 31
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LoginOrEmail"), "html", null, true);
        yield "
                            </label>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"login_form_nonce\" value=\"";
        // line 38
        yield \Piwik\piwik_escape_filter($this->env, (isset($context["nonce"]) || array_key_exists("nonce", $context) ? $context["nonce"] : (function () { throw new RuntimeError('Variable "nonce" does not exist.', 38, $this->source); })()), "html", null, true);
        yield "\"/>
                            <input type=\"hidden\" name=\"form_redirect\" id=\"login_form_redirect\" value=\"\"/>
                            <input type=\"password\" name=\"form_password\" id=\"login_form_password\" class=\"input\"
                                   value=\"\" size=\"20\" placeholder=\"\" autocomplete=\"current-password\" autocorrect=\"off\"
                                   autocapitalize=\"none\" spellcheck=\"false\" tabindex=\"20\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <label for=\"login_form_password\">
                                <i class=\"icon-locked icon\"></i> ";
        // line 45
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Password"), "html", null, true);
        yield "
                            </label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s6\">
                            <label>
                                <input name=\"form_rememberme\" type=\"checkbox\" id=\"login_form_rememberme\" value=\"1\"
                                       tabindex=\"90\"
                                       ";
        // line 55
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form_data"]) || array_key_exists("form_data", $context) ? $context["form_data"] : (function () { throw new RuntimeError('Variable "form_data" does not exist.', 55, $this->source); })()), "form_rememberme", [], "any", false, false, false, 55), "value", [], "any", false, false, false, 55)) {
            yield "checked=\"checked\" ";
        }
        yield "/>
                                <span>";
        // line 56
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_RememberMe"), "html", null, true);
        yield "</span>
                            </label>
                        </div>
                        <div class=\"col s6 right-align\">
                            <a id=\"login_form_nav\" href=\"#\" tabindex=\"95\"
                               title=\"";
        // line 61
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LostYourPassword"), "html", null, true);
        yield "\">
                                ";
        // line 62
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LostYourPassword"), "html", null, true);
        yield "
                            </a>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id=\"login_form_submit\" type=\"submit\"
                                   value=\"";
        // line 69
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LogIn"), "html", null, true);
        yield "\" tabindex=\"100\" disabled=\"disabled\"
                            />
                        </div>
                    </div>
                </form>

                <div class=\"row\">
                    <div class=\"col s12\">
                        ";
        // line 77
        yield $this->env->getFunction('postEvent')->getCallable()("Template.loginNav", "top");
        yield "
                        ";
        // line 78
        yield $this->env->getFunction('postEvent')->getCallable()("Template.loginNav", "bottom");
        yield "
                    </div>
                </div>

                ";
        // line 82
        if ((isset($context["isCustomLogo"]) || array_key_exists("isCustomLogo", $context) ? $context["isCustomLogo"] : (function () { throw new RuntimeError('Variable "isCustomLogo" does not exist.', 82, $this->source); })())) {
            // line 83
            yield "                    <p id=\"piwik\">
                        <i><a href=\"";
            // line 84
            yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('trackmatomolink')->getCallable()("https://matomo.org/"), "html", null, true);
            yield "\" rel=\"noreferrer noopener\" target=\"_blank\">";
            yield \Piwik\piwik_escape_filter($this->env, (isset($context["linkTitle"]) || array_key_exists("linkTitle", $context) ? $context["linkTitle"] : (function () { throw new RuntimeError('Variable "linkTitle" does not exist.', 84, $this->source); })()), "html", null, true);
            yield "</a></i>
                    </p>
                ";
        }
        // line 87
        yield "
            ";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@Login/login.twig";
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
        return array (  437 => 87,  429 => 84,  426 => 83,  424 => 82,  417 => 78,  413 => 77,  402 => 69,  392 => 62,  388 => 61,  380 => 56,  374 => 55,  361 => 45,  351 => 38,  341 => 31,  331 => 24,  328 => 23,  322 => 21,  320 => 20,  317 => 19,  309 => 16,  304 => 13,  302 => 12,  297 => 10,  293 => 8,  289 => 7,  278 => 6,  62 => 157,  60 => 92,  56 => 90,  54 => 6,  51 => 5,  47 => 4,  36 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("
{% extends '@Login/loginLayout.twig' %}

{% block loginContent %}
    <div class=\"contentForm loginForm\">
        {% embed 'contentBlock.twig' with {'title': 'Login_LogIn'|translate} %}
            {% block content %}
                <div class=\"message_container\">

                    {{ include('@Login/_formErrors.twig', {formErrors: form_data.errors } )  }}

                    {% if AccessErrorString %}
                        <div vue-entry=\"CoreHome.Notification\"
                             noclear=\"true\"
                             context=\"error\">
                            <strong>{{ 'General_Error'|translate }}</strong>: {{ AccessErrorString|raw }}<br/>
                        </div>
                    {% endif %}

                    {% if infoMessage %}
                        <div class=\"alert alert-info\">{{ infoMessage|raw }}</div>
                    {% endif %}
                </div>
                <form {{ form_data.attributes|raw }}>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"text\" name=\"form_login\" id=\"login_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   placeholder=\"\" autocomplete=\"username\" autocorrect=\"off\" autocapitalize=\"none\"
                                   spellcheck=\"false\" tabindex=\"10\" autofocus=\"autofocus\" />
                            <label for=\"login_form_login\">
                                <i class=\"icon-user icon\"></i> {{ 'Login_LoginOrEmail'|translate }}
                            </label>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"login_form_nonce\" value=\"{{ nonce }}\"/>
                            <input type=\"hidden\" name=\"form_redirect\" id=\"login_form_redirect\" value=\"\"/>
                            <input type=\"password\" name=\"form_password\" id=\"login_form_password\" class=\"input\"
                                   value=\"\" size=\"20\" placeholder=\"\" autocomplete=\"current-password\" autocorrect=\"off\"
                                   autocapitalize=\"none\" spellcheck=\"false\" tabindex=\"20\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <label for=\"login_form_password\">
                                <i class=\"icon-locked icon\"></i> {{ 'General_Password'|translate }}
                            </label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s6\">
                            <label>
                                <input name=\"form_rememberme\" type=\"checkbox\" id=\"login_form_rememberme\" value=\"1\"
                                       tabindex=\"90\"
                                       {% if form_data.form_rememberme.value %}checked=\"checked\" {% endif %}/>
                                <span>{{ 'Login_RememberMe'|translate }}</span>
                            </label>
                        </div>
                        <div class=\"col s6 right-align\">
                            <a id=\"login_form_nav\" href=\"#\" tabindex=\"95\"
                               title=\"{{ 'Login_LostYourPassword'|translate }}\">
                                {{ 'Login_LostYourPassword'|translate }}
                            </a>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id=\"login_form_submit\" type=\"submit\"
                                   value=\"{{ 'Login_LogIn'|translate }}\" tabindex=\"100\" disabled=\"disabled\"
                            />
                        </div>
                    </div>
                </form>

                <div class=\"row\">
                    <div class=\"col s12\">
                        {{ postEvent(\"Template.loginNav\", \"top\") }}
                        {{ postEvent(\"Template.loginNav\", \"bottom\") }}
                    </div>
                </div>

                {% if isCustomLogo %}
                    <p id=\"piwik\">
                        <i><a href=\"{{ 'https://matomo.org/'|trackmatomolink }}\" rel=\"noreferrer noopener\" target=\"_blank\">{{ linkTitle }}</a></i>
                    </p>
                {% endif %}

            {% endblock %}
        {% endembed %}
    </div>
    <div class=\"contentForm resetForm\" style=\"display:none;\">
        {% embed 'contentBlock.twig' with {'title': 'Login_ChangeYourPassword'|translate} %}
            {% block content %}

                <div class=\"message_container\">
                </div>

                <form id=\"reset_form\" method=\"post\">
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"reset_form_nonce\" value=\"{{ nonce }}\"/>
                            <input type=\"text\" placeholder=\"\" name=\"form_login\" id=\"reset_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\"
                                   tabindex=\"10\"/>
                            <label for=\"reset_form_login\"><i class=\"icon-user icon\"></i> {{ 'Login_LoginOrEmail'|translate }}</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password\" id=\"reset_form_password\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   tabindex=\"20\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password\"
                                 validation-rules=\"{{ passwordStrengthValidationRules|json_encode }}\"
                            ></div>
                            <label for=\"reset_form_password\"><i class=\"icon-locked icon\"></i> {{ 'Login_NewPassword'|translate }}</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password_bis\" id=\"reset_form_password_bis\" class=\"input\" value=\"\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   size=\"20\" tabindex=\"30\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password_bis\"
                                 validation-rules=\"{{ passwordStrengthValidationRules|json_encode }}\"
                            ></div>
                            <label for=\"reset_form_password_bis\"><i class=\"icon-locked icon\"></i> {{ 'Login_NewPasswordRepeat'|translate }}</label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id='reset_form_submit' type=\"submit\"
                                   value=\"{{ 'General_ChangePassword'|translate }}\" tabindex=\"100\"/>

                            <span class=\"loadingPiwik\" style=\"display:none;\">
                                {% include \"@CoreHome/_loader.twig\" %}
                            </span>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"module\" value=\"{{ loginModule }}\"/>
                    <input type=\"hidden\" name=\"action\" value=\"resetPassword\"/>
                </form>
                <p id=\"nav\">
                    <a id=\"reset_form_nav\" href=\"#\"
                       title=\"{{ 'Mobile_NavigationBack'|translate }}\">{{ 'General_Cancel'|translate }}</a>
                    <a id=\"alternate_reset_nav\" href=\"#\" style=\"display:none;\"
                       title=\"{{'Login_LogIn'|translate}}\">{{ 'Login_LogIn'|translate }}</a>
                </p>
            {% endblock %}
        {% endembed %}
    </div>

{% endblock %}
", "@Login/login.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/Login/templates/login.twig");
    }
}


/* @Login/login.twig */
class __TwigTemplate_9854e990fbe3187bebd5cb7b5916a0a5___1987587998 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 92
        return "contentBlock.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("contentBlock.twig", "@Login/login.twig", 92);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 93
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 94
        yield "
                <div class=\"message_container\">
                </div>

                <form id=\"reset_form\" method=\"post\">
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"reset_form_nonce\" value=\"";
        // line 101
        yield \Piwik\piwik_escape_filter($this->env, (isset($context["nonce"]) || array_key_exists("nonce", $context) ? $context["nonce"] : (function () { throw new RuntimeError('Variable "nonce" does not exist.', 101, $this->source); })()), "html", null, true);
        yield "\"/>
                            <input type=\"text\" placeholder=\"\" name=\"form_login\" id=\"reset_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\"
                                   tabindex=\"10\"/>
                            <label for=\"reset_form_login\"><i class=\"icon-user icon\"></i> ";
        // line 105
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LoginOrEmail"), "html", null, true);
        yield "</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password\" id=\"reset_form_password\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   tabindex=\"20\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password\"
                                 validation-rules=\"";
        // line 116
        yield \Piwik\piwik_escape_filter($this->env, json_encode((isset($context["passwordStrengthValidationRules"]) || array_key_exists("passwordStrengthValidationRules", $context) ? $context["passwordStrengthValidationRules"] : (function () { throw new RuntimeError('Variable "passwordStrengthValidationRules" does not exist.', 116, $this->source); })())), "html", null, true);
        yield "\"
                            ></div>
                            <label for=\"reset_form_password\"><i class=\"icon-locked icon\"></i> ";
        // line 118
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_NewPassword"), "html", null, true);
        yield "</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password_bis\" id=\"reset_form_password_bis\" class=\"input\" value=\"\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   size=\"20\" tabindex=\"30\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password_bis\"
                                 validation-rules=\"";
        // line 129
        yield \Piwik\piwik_escape_filter($this->env, json_encode((isset($context["passwordStrengthValidationRules"]) || array_key_exists("passwordStrengthValidationRules", $context) ? $context["passwordStrengthValidationRules"] : (function () { throw new RuntimeError('Variable "passwordStrengthValidationRules" does not exist.', 129, $this->source); })())), "html", null, true);
        yield "\"
                            ></div>
                            <label for=\"reset_form_password_bis\"><i class=\"icon-locked icon\"></i> ";
        // line 131
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_NewPasswordRepeat"), "html", null, true);
        yield "</label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id='reset_form_submit' type=\"submit\"
                                   value=\"";
        // line 138
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_ChangePassword"), "html", null, true);
        yield "\" tabindex=\"100\"/>

                            <span class=\"loadingPiwik\" style=\"display:none;\">
                                ";
        // line 141
        yield from         $this->loadTemplate("@CoreHome/_loader.twig", "@Login/login.twig", 141)->unwrap()->yield($context);
        // line 142
        yield "                            </span>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"module\" value=\"";
        // line 146
        yield \Piwik\piwik_escape_filter($this->env, (isset($context["loginModule"]) || array_key_exists("loginModule", $context) ? $context["loginModule"] : (function () { throw new RuntimeError('Variable "loginModule" does not exist.', 146, $this->source); })()), "html", null, true);
        yield "\"/>
                    <input type=\"hidden\" name=\"action\" value=\"resetPassword\"/>
                </form>
                <p id=\"nav\">
                    <a id=\"reset_form_nav\" href=\"#\"
                       title=\"";
        // line 151
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Mobile_NavigationBack"), "html", null, true);
        yield "\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("General_Cancel"), "html", null, true);
        yield "</a>
                    <a id=\"alternate_reset_nav\" href=\"#\" style=\"display:none;\"
                       title=\"";
        // line 153
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LogIn"), "html", null, true);
        yield "\">";
        yield \Piwik\piwik_escape_filter($this->env, $this->env->getFilter('translate')->getCallable()("Login_LogIn"), "html", null, true);
        yield "</a>
                </p>
            ";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@Login/login.twig";
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
        return array (  760 => 153,  753 => 151,  745 => 146,  739 => 142,  737 => 141,  731 => 138,  721 => 131,  716 => 129,  702 => 118,  697 => 116,  683 => 105,  676 => 101,  667 => 94,  663 => 93,  652 => 92,  437 => 87,  429 => 84,  426 => 83,  424 => 82,  417 => 78,  413 => 77,  402 => 69,  392 => 62,  388 => 61,  380 => 56,  374 => 55,  361 => 45,  351 => 38,  341 => 31,  331 => 24,  328 => 23,  322 => 21,  320 => 20,  317 => 19,  309 => 16,  304 => 13,  302 => 12,  297 => 10,  293 => 8,  289 => 7,  278 => 6,  62 => 157,  60 => 92,  56 => 90,  54 => 6,  51 => 5,  47 => 4,  36 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("
{% extends '@Login/loginLayout.twig' %}

{% block loginContent %}
    <div class=\"contentForm loginForm\">
        {% embed 'contentBlock.twig' with {'title': 'Login_LogIn'|translate} %}
            {% block content %}
                <div class=\"message_container\">

                    {{ include('@Login/_formErrors.twig', {formErrors: form_data.errors } )  }}

                    {% if AccessErrorString %}
                        <div vue-entry=\"CoreHome.Notification\"
                             noclear=\"true\"
                             context=\"error\">
                            <strong>{{ 'General_Error'|translate }}</strong>: {{ AccessErrorString|raw }}<br/>
                        </div>
                    {% endif %}

                    {% if infoMessage %}
                        <div class=\"alert alert-info\">{{ infoMessage|raw }}</div>
                    {% endif %}
                </div>
                <form {{ form_data.attributes|raw }}>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"text\" name=\"form_login\" id=\"login_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   placeholder=\"\" autocomplete=\"username\" autocorrect=\"off\" autocapitalize=\"none\"
                                   spellcheck=\"false\" tabindex=\"10\" autofocus=\"autofocus\" />
                            <label for=\"login_form_login\">
                                <i class=\"icon-user icon\"></i> {{ 'Login_LoginOrEmail'|translate }}
                            </label>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"login_form_nonce\" value=\"{{ nonce }}\"/>
                            <input type=\"hidden\" name=\"form_redirect\" id=\"login_form_redirect\" value=\"\"/>
                            <input type=\"password\" name=\"form_password\" id=\"login_form_password\" class=\"input\"
                                   value=\"\" size=\"20\" placeholder=\"\" autocomplete=\"current-password\" autocorrect=\"off\"
                                   autocapitalize=\"none\" spellcheck=\"false\" tabindex=\"20\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <label for=\"login_form_password\">
                                <i class=\"icon-locked icon\"></i> {{ 'General_Password'|translate }}
                            </label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s6\">
                            <label>
                                <input name=\"form_rememberme\" type=\"checkbox\" id=\"login_form_rememberme\" value=\"1\"
                                       tabindex=\"90\"
                                       {% if form_data.form_rememberme.value %}checked=\"checked\" {% endif %}/>
                                <span>{{ 'Login_RememberMe'|translate }}</span>
                            </label>
                        </div>
                        <div class=\"col s6 right-align\">
                            <a id=\"login_form_nav\" href=\"#\" tabindex=\"95\"
                               title=\"{{ 'Login_LostYourPassword'|translate }}\">
                                {{ 'Login_LostYourPassword'|translate }}
                            </a>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id=\"login_form_submit\" type=\"submit\"
                                   value=\"{{ 'Login_LogIn'|translate }}\" tabindex=\"100\" disabled=\"disabled\"
                            />
                        </div>
                    </div>
                </form>

                <div class=\"row\">
                    <div class=\"col s12\">
                        {{ postEvent(\"Template.loginNav\", \"top\") }}
                        {{ postEvent(\"Template.loginNav\", \"bottom\") }}
                    </div>
                </div>

                {% if isCustomLogo %}
                    <p id=\"piwik\">
                        <i><a href=\"{{ 'https://matomo.org/'|trackmatomolink }}\" rel=\"noreferrer noopener\" target=\"_blank\">{{ linkTitle }}</a></i>
                    </p>
                {% endif %}

            {% endblock %}
        {% endembed %}
    </div>
    <div class=\"contentForm resetForm\" style=\"display:none;\">
        {% embed 'contentBlock.twig' with {'title': 'Login_ChangeYourPassword'|translate} %}
            {% block content %}

                <div class=\"message_container\">
                </div>

                <form id=\"reset_form\" method=\"post\">
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"hidden\" name=\"form_nonce\" id=\"reset_form_nonce\" value=\"{{ nonce }}\"/>
                            <input type=\"text\" placeholder=\"\" name=\"form_login\" id=\"reset_form_login\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\"
                                   tabindex=\"10\"/>
                            <label for=\"reset_form_login\"><i class=\"icon-user icon\"></i> {{ 'Login_LoginOrEmail'|translate }}</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password\" id=\"reset_form_password\" class=\"input\" value=\"\" size=\"20\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   tabindex=\"20\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password\"
                                 validation-rules=\"{{ passwordStrengthValidationRules|json_encode }}\"
                            ></div>
                            <label for=\"reset_form_password\"><i class=\"icon-locked icon\"></i> {{ 'Login_NewPassword'|translate }}</label>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col s12 input-field\">
                            <input type=\"password\" placeholder=\"\" name=\"form_password_bis\" id=\"reset_form_password_bis\" class=\"input\" value=\"\"
                                   autocorrect=\"off\" autocapitalize=\"none\" spellcheck=\"false\"
                                   size=\"20\" tabindex=\"30\" autocomplete=\"off\"
                                   vue-directive=\"CoreHome.AutoClearPassword\" />
                            <div vue-entry=\"CoreHome.PasswordStrength\"
                                 external-input-selector=\"#reset_form_password_bis\"
                                 validation-rules=\"{{ passwordStrengthValidationRules|json_encode }}\"
                            ></div>
                            <label for=\"reset_form_password_bis\"><i class=\"icon-locked icon\"></i> {{ 'Login_NewPasswordRepeat'|translate }}</label>
                        </div>
                    </div>

                    <div class=\"row actions\">
                        <div class=\"col s12\">
                            <input class=\"submit btn btn-block\" id='reset_form_submit' type=\"submit\"
                                   value=\"{{ 'General_ChangePassword'|translate }}\" tabindex=\"100\"/>

                            <span class=\"loadingPiwik\" style=\"display:none;\">
                                {% include \"@CoreHome/_loader.twig\" %}
                            </span>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"module\" value=\"{{ loginModule }}\"/>
                    <input type=\"hidden\" name=\"action\" value=\"resetPassword\"/>
                </form>
                <p id=\"nav\">
                    <a id=\"reset_form_nav\" href=\"#\"
                       title=\"{{ 'Mobile_NavigationBack'|translate }}\">{{ 'General_Cancel'|translate }}</a>
                    <a id=\"alternate_reset_nav\" href=\"#\" style=\"display:none;\"
                       title=\"{{'Login_LogIn'|translate}}\">{{ 'Login_LogIn'|translate }}</a>
                </p>
            {% endblock %}
        {% endembed %}
    </div>

{% endblock %}
", "@Login/login.twig", "/var/www/cse135phyosithu.site/public_html/matomo/plugins/Login/templates/login.twig");
    }
}
