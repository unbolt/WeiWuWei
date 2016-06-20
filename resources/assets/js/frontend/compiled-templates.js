this["WEI"] = this["WEI"] || {};
this["WEI"]["templates"] = this["WEI"]["templates"] || {};
this["WEI"]["templates"]["characters"] = this["WEI"]["templates"]["characters"] || {};
this["WEI"]["templates"]["characters"]["profile"] = this["WEI"]["templates"]["characters"]["profile"] || {};
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