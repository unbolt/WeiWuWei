this["WEI"] = this["WEI"] || {};
this["WEI"]["templates"] = this["WEI"]["templates"] || {};
this["WEI"]["templates"]["characters"] = this["WEI"]["templates"]["characters"] || {};
this["WEI"]["templates"]["characters"]["profile"] = this["WEI"]["templates"]["characters"]["profile"] || {};
this["WEI"]["templates"]["characters"]["profile"]["name"] = Handlebars.template({"compiler":[7,">= 4.0.0"],"main":function(container,depth0,helpers,partials,data) {
    var helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression;

  return "<div class=\"character-name character-class-"
    + alias4(((helper = (helper = helpers.characterClass || (depth0 != null ? depth0.characterClass : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"characterClass","hash":{},"data":data}) : helper)))
    + "\">\n    "
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "\n</div>\n";
},"useData":true});
this["WEI"]["templates"]["characters"]["profile"]["roster"] = Handlebars.template({"1":function(container,depth0,helpers,partials,data) {
    var helper;

  return "            <a href=\"http://twitch.tv/"
    + container.escapeExpression(((helper = (helper = helpers.twitch || (depth0 != null ? depth0.twitch : depth0)) != null ? helper : helpers.helperMissing),(typeof helper === "function" ? helper.call(depth0 != null ? depth0 : {},{"name":"twitch","hash":{},"data":data}) : helper)))
    + "\" target=\"_blank\"><i class=\"fa fa-twitch\" aria-hidden=\"true\"></i></a>\n";
},"3":function(container,depth0,helpers,partials,data) {
    var helper;

  return "            <a href=\"http://twitter.com/"
    + container.escapeExpression(((helper = (helper = helpers.twitter || (depth0 != null ? depth0.twitter : depth0)) != null ? helper : helpers.helperMissing),(typeof helper === "function" ? helper.call(depth0 != null ? depth0 : {},{"name":"twitter","hash":{},"data":data}) : helper)))
    + "\" target=\"_blank\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a>\n";
},"5":function(container,depth0,helpers,partials,data) {
    var helper;

  return "            <a href=\"http://youtube.com/"
    + container.escapeExpression(((helper = (helper = helpers.youtube || (depth0 != null ? depth0.youtube : depth0)) != null ? helper : helpers.helperMissing),(typeof helper === "function" ? helper.call(depth0 != null ? depth0 : {},{"name":"youtube","hash":{},"data":data}) : helper)))
    + "\" target=\"_blank\"><i class=\"fa fa-youtube\" aria-hidden=\"true\"></i></a>\n";
},"compiler":[7,">= 4.0.0"],"main":function(container,depth0,helpers,partials,data) {
    var stack1, helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression;

  return "\n<div class=\"character-profile-roster character-class-"
    + alias4(((helper = (helper = helpers.characterClass || (depth0 != null ? depth0.characterClass : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"characterClass","hash":{},"data":data}) : helper)))
    + "\">\n    <div class=\"character-race-"
    + alias4(((helper = (helper = helpers.race || (depth0 != null ? depth0.race : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"race","hash":{},"data":data}) : helper)))
    + " hidden-sm hidden-xs\"></div>\n\n    <div class=\"character-avatar pull-left\">\n        <img src=\""
    + alias4(((helper = (helper = helpers.thumbnail || (depth0 != null ? depth0.thumbnail : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"thumbnail","hash":{},"data":data}) : helper)))
    + "\" class=\"img-circle\" />\n    </div>\n\n    <div class=\"character-name character-class-"
    + alias4(((helper = (helper = helpers.characterClass || (depth0 != null ? depth0.characterClass : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"characterClass","hash":{},"data":data}) : helper)))
    + "\">\n        "
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "\n    </div>\n    <div class=\"character-server hidden-sm hidden-xs\">\n        "
    + alias4(((helper = (helper = helpers.realm || (depth0 != null ? depth0.realm : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"realm","hash":{},"data":data}) : helper)))
    + "\n    </div>\n    <div class=\"character-social\">\n            <a href=\"http://eu.battle.net/wow/en/character/"
    + alias4(((helper = (helper = helpers.serverslug || (depth0 != null ? depth0.serverslug : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"serverslug","hash":{},"data":data}) : helper)))
    + "/"
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "/simple\" target=\"_blank\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i></a>\n"
    + ((stack1 = helpers["if"].call(alias1,(depth0 != null ? depth0.twitch : depth0),{"name":"if","hash":{},"fn":container.program(1, data, 0),"inverse":container.noop,"data":data})) != null ? stack1 : "")
    + ((stack1 = helpers["if"].call(alias1,(depth0 != null ? depth0.twitter : depth0),{"name":"if","hash":{},"fn":container.program(3, data, 0),"inverse":container.noop,"data":data})) != null ? stack1 : "")
    + ((stack1 = helpers["if"].call(alias1,(depth0 != null ? depth0.youtube : depth0),{"name":"if","hash":{},"fn":container.program(5, data, 0),"inverse":container.noop,"data":data})) != null ? stack1 : "")
    + "    </div>\n</div>\n";
},"useData":true});
this["WEI"]["templates"]["characters"]["profile"]["side"] = Handlebars.template({"compiler":[7,">= 4.0.0"],"main":function(container,depth0,helpers,partials,data) {
    var helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression;

  return "<div class=\"character_profile_side\">\n    <div class=\"character-race-"
    + alias4(((helper = (helper = helpers.race || (depth0 != null ? depth0.race : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"race","hash":{},"data":data}) : helper)))
    + " hidden-sm hidden-xs\"></div>\n    <div class=\"character-details\">\n        <div class=\"character-name character-class-"
    + alias4(((helper = (helper = helpers.characterClass || (depth0 != null ? depth0.characterClass : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"characterClass","hash":{},"data":data}) : helper)))
    + "\">\n            "
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + "\n        </div>\n        <div class=\"character-server hidden-sm hidden-xs\">\n            "
    + alias4(((helper = (helper = helpers.realm || (depth0 != null ? depth0.realm : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"realm","hash":{},"data":data}) : helper)))
    + "\n        </div>\n        <div class=\"character-avatar hidden-sm hidden-xs\">\n            <img src=\""
    + alias4(((helper = (helper = helpers.thumbnail || (depth0 != null ? depth0.thumbnail : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"thumbnail","hash":{},"data":data}) : helper)))
    + "\" class=\"img-circle\" />\n        </div>\n        <div class=\"character-achievements hidden-sm hidden-xs\">\n            <i class=\"fa fa-shield\" aria-hidden=\"true\"></i> <span>"
    + alias4((helpers.formatNumber || (depth0 && depth0.formatNumber) || alias2).call(alias1,(depth0 != null ? depth0.achievementPoints : depth0),{"name":"formatNumber","hash":{},"data":data}))
    + "</span>\n        </div>\n    </div>\n</div>\n";
},"useData":true});
this["WEI"]["templates"]["characters"]["profile"]["small"] = Handlebars.template({"compiler":[7,">= 4.0.0"],"main":function(container,depth0,helpers,partials,data) {
    var helper, alias1=depth0 != null ? depth0 : {}, alias2=helpers.helperMissing, alias3="function", alias4=container.escapeExpression;

  return "<div class=\"character_profile_small\">\n    "
    + alias4(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"name","hash":{},"data":data}) : helper)))
    + " - "
    + alias4(((helper = (helper = helpers.achievementPoints || (depth0 != null ? depth0.achievementPoints : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"achievementPoints","hash":{},"data":data}) : helper)))
    + "\n\n    <p>\n        <img src=\""
    + alias4(((helper = (helper = helpers.thumbnail || (depth0 != null ? depth0.thumbnail : depth0)) != null ? helper : alias2),(typeof helper === alias3 ? helper.call(alias1,{"name":"thumbnail","hash":{},"data":data}) : helper)))
    + "\" />\n    </p>\n</div>\n";
},"useData":true});