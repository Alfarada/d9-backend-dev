<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @webprofiler/Collector/forms.html.twig */
class __TwigTemplate_75ad5d2868a5fb6211fe325adc99750e extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'toolbar' => [$this, 'block_toolbar'],
            'panel' => [$this, 'block_panel'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2 = $this->extensions["Drupal\\webprofiler\\Twig\\Extension\\ProfilerExtension"];
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2->enter($__internal_b3d9dd94c58234fbec4409b98abb5cb2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@webprofiler/Collector/forms.html.twig"));

        // line 1
        $this->displayBlock('toolbar', $context, $blocks);
        // line 24
        echo "
";
        // line 25
        $this->displayBlock('panel', $context, $blocks);
        
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2->leave($__internal_b3d9dd94c58234fbec4409b98abb5cb2_prof);

    }

    // line 1
    public function block_toolbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2 = $this->extensions["Drupal\\webprofiler\\Twig\\Extension\\ProfilerExtension"];
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2->enter($__internal_b3d9dd94c58234fbec4409b98abb5cb2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 2
        echo "    ";
        ob_start(function () { return ''; });
        // line 3
        echo "    <a href=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getUrl("webprofiler.dashboard", ["profile" => ($context["token"] ?? null)], ["fragment" => "forms"]), "html", null, true);
        echo "\" title=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Forms"));
        echo "\">
        <img width=\"21\" height=\"28\" alt=\"";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Forms"));
        echo "\"
             src=\"data:image/png;base64,";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["collector"] ?? null), "icon", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
        echo "\">
        <span class=\"sf-toolbar-info-piece-additional sf-toolbar-status\">";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["collector"] ?? null), "getFormsCount", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
        echo "</span>
    </a>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        echo "    ";
        ob_start(function () { return ''; });
        // line 10
        echo "        <div class=\"sf-toolbar-info-piece\">
            ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["collector"] ?? null), "getForms", [], "any", false, false, true, 11));
        foreach ($context['_seq'] as $context["keys"] => $context["form"]) {
            // line 12
            echo "                <b>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["keys"], 12, $this->source), "html", null, true);
            echo "</b>
                <div><a href=\"";
            // line 13
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\webprofiler\Twig\Extension\ProfilerExtension']->getIdeLink($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["form"], "class", [], "any", false, false, true, 13), "file", [], "any", false, false, true, 13), 13, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["form"], "class", [], "any", false, false, true, 13), "line", [], "any", false, false, true, 13), 13, $this->source)));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\webprofiler\Twig\Extension\ProfilerExtension']->getAbbr($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["form"], "class", [], "any", false, false, true, 13), "class", [], "any", false, false, true, 13), 13, $this->source)));
            echo "
                        ::";
            // line 14
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["form"], "class", [], "any", false, false, true, 14), "method", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
            echo "</a></div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['keys'], $context['form'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 18
        echo "
    <div class=\"sf-toolbar-block\">
        <div class=\"sf-toolbar-icon\">";
        // line 20
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((array_key_exists("icon", $context)) ? (_twig_default_filter($this->sandbox->ensureToStringAllowed(($context["icon"] ?? null), 20, $this->source), "")) : ("")), "html", null, true);
        echo "</div>
        <div class=\"sf-toolbar-info\">";
        // line 21
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((array_key_exists("text", $context)) ? (_twig_default_filter($this->sandbox->ensureToStringAllowed(($context["text"] ?? null), 21, $this->source), "")) : ("")), "html", null, true);
        echo "</div>
    </div>
";
        
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2->leave($__internal_b3d9dd94c58234fbec4409b98abb5cb2_prof);

    }

    // line 25
    public function block_panel($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2 = $this->extensions["Drupal\\webprofiler\\Twig\\Extension\\ProfilerExtension"];
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2->enter($__internal_b3d9dd94c58234fbec4409b98abb5cb2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 26
        echo "    <script id=\"forms\" type=\"text/template\">
        <h2 class=\"panel__title\">";
        // line 27
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Forms"));
        echo "</h2>
        <% if( data.forms && data.forms.length != 0){ %>
            <% _.each( data.forms, function( item, key ){ %>
                <div class=\"panel__container\">

                    <ul class=\"list--inline\">
                        <li><b>ID</b> <%= key %></li>
                        <li><b>class</b> <%= Drupal.webprofiler.helpers.classLink(item.class) %></li>
                    </ul>

                    <table class=\"table--compact\">
                        <thead>
                        <tr>
                            <th>";
        // line 40
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("form"));
        echo "</th>
                            <th>";
        // line 41
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("title"));
        echo "</th>
                            <th>";
        // line 42
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("access"));
        echo "</th>
                            <th>";
        // line 43
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("type"));
        echo "</th>
                        </tr>
                        </thead>
                        <tbody>
                        <% _.each( item.form, function( value , key ){ %>
                        <tr>
                            <td><%= key %></td>
                            <td><% if(value['#title'] == null ){ %> ";
        // line 50
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("-");
        echo " <% } else { %> <%= value['#title'] %><% } %></td>
                            <td><% if(value['#access'] == null ){ %> ";
        // line 51
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("null");
        echo " <% } else { %> <%= value['#access'] %><% } %></td>
                            <td><% if(value['#type'] == null ){ %> ";
        // line 52
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("null");
        echo " <% } else { %> <%= value['#type'] %><% } %></td>
                        </tr>
                        <% }); %>
                        </tbody>
                    </table>
                </div>
            <% }); %>
        <% } else { %>
            <div class=\"panel__container\">
                <p>";
        // line 61
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("No results"));
        echo "</p>
            </div>
        <% } %>
    </script>
";
        
        $__internal_b3d9dd94c58234fbec4409b98abb5cb2->leave($__internal_b3d9dd94c58234fbec4409b98abb5cb2_prof);

    }

    public function getTemplateName()
    {
        return "@webprofiler/Collector/forms.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  206 => 61,  194 => 52,  190 => 51,  186 => 50,  176 => 43,  172 => 42,  168 => 41,  164 => 40,  148 => 27,  145 => 26,  138 => 25,  128 => 21,  124 => 20,  120 => 18,  116 => 16,  108 => 14,  102 => 13,  97 => 12,  93 => 11,  90 => 10,  87 => 9,  81 => 6,  77 => 5,  73 => 4,  66 => 3,  63 => 2,  56 => 1,  49 => 25,  46 => 24,  44 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@webprofiler/Collector/forms.html.twig", "/var/www/html/d9-back-dev/web/modules/contrib/webprofiler/templates/Collector/forms.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("block" => 1, "set" => 2, "for" => 11);
        static $filters = array("escape" => 3, "t" => 3, "raw" => 13, "default" => 20);
        static $functions = array("url" => 3, "idelink" => 13, "abbr" => 13);

        try {
            $this->sandbox->checkSecurity(
                ['block', 'set', 'for'],
                ['escape', 't', 'raw', 'default'],
                ['url', 'idelink', 'abbr']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
