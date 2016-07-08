this["WEI"] = this["WEI"] || {};
this["WEI"]["templates"] = this["WEI"]["templates"] || {};
this["WEI"]["templates"]["characters"] = this["WEI"]["templates"]["characters"] || {};
this["WEI"]["templates"]["characters"]["profile"] = this["WEI"]["templates"]["characters"]["profile"] || {};
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