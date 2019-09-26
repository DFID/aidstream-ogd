<?php
namespace App\Core\V201\Repositories\Organization;

use App\Models\Organization\OrganizationData;

class RecipientCountryBudgetRepository
{
    /**
     * @var OrganizationData
     */
    private $org;

    /**
     * @param OrganizationData $org
     */
    function __construct(OrganizationData $org)
    {
        $this->org = $org;
    }

    /**
     * @param $input
     * @param $organization
     * @return bool
     */
    public function update(array $input, OrganizationData $organization)
    {   
        if($organization->id == 99999999999999){
            $tempVal = [];
            $tempVal[0]['recipient_country'][0]["code"]= "VN";
            $tempVal[0]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[0]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[0]["period_start"][0]["date"]= "2015-04-01";
            $tempVal[0]["period_end"][0]["date"]= "2016-03-31";
            $tempVal[0]["value"][0]["amount"]= "876960";
            $tempVal[0]["value"][0]["currency"]= "GBP";
            $tempVal[0]["value"][0]["value_date"]= "2015-04-01";
            $tempVal[0]["budget_line"][0]["reference"]= "FF_Vietnam_Project";
            $tempVal[0]["budget_line"][0]["value"][0]["amount"]= "876960";
            $tempVal[0]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[0]["budget_line"][0]["value"][0]["value_date"]= "2015-04-01";
            $tempVal[0]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund - Vietnam Pilot Project";
            $tempVal[0]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[1]['recipient_country'][0]["code"]= "VN";
            $tempVal[1]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[1]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[1]["period_start"][0]["date"]= "2016-04-01";
            $tempVal[1]["period_end"][0]["date"]= "2017-03-31";
            $tempVal[1]["value"][0]["amount"]= 678456;
            $tempVal[1]["value"][0]["currency"]= "GBP";
            $tempVal[1]["value"][0]["value_date"]= "2016-04-01";
            $tempVal[1]["budget_line"][0]["reference"]= "FF_Vietnam_Project";
            $tempVal[1]["budget_line"][0]["value"][0]["amount"]= 678456;
            $tempVal[1]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[1]["budget_line"][0]["value"][0]["value_date"]= "2016-04-01";
            $tempVal[1]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund - Vietnam Pilot Project";
            $tempVal[1]["budget_line"][0]["narrative"][0]["language"]= "";
            $tempVal[2]['recipient_country'][0]["code"]= "VN";
            $tempVal[2]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[2]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[2]["period_start"][0]["date"]= "2018-04-01";
            $tempVal[2]["period_end"][0]["date"]= "2019-03-31";
            $tempVal[2]["value"][0]["amount"]= 344132.82;
            $tempVal[2]["value"][0]["currency"]= "GBP";
            $tempVal[2]["value"][0]["value_date"]= "2018-04-01";
            $tempVal[2]["budget_line"][0]["reference"]= "FF_Vietnam_Project";
            $tempVal[2]["budget_line"][0]["value"][0]["amount"]= 341051.15;
            $tempVal[2]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[2]["budget_line"][0]["value"][0]["value_date"]= "2018-04-01";
            $tempVal[2]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund - Vietnam Pilot Project";
            $tempVal[2]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[2]["budget_line"][1]["reference"]= "FF_MA";
            $tempVal[2]["budget_line"][1]["value"][0]["amount"]= 3081.67;
            $tempVal[2]["budget_line"][1]["value"][0]["currency"]= "GBP";
            $tempVal[2]["budget_line"][1]["value"][0]["value_date"]= "2018-04-01";
            $tempVal[2]["budget_line"][1]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[2]["budget_line"][1]["narrative"][0]["language"]= "";
            $tempVal[3]['recipient_country'][0]["code"]= "VN";
            $tempVal[3]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[3]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[3]["period_start"][0]["date"]= "2019-04-01";
            $tempVal[3]["period_end"][0]["date"]= "2020-03-31";
            $tempVal[3]["value"][0]["amount"]= 5221178.75;
            $tempVal[3]["value"][0]["currency"]= "GBP";
            $tempVal[3]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[3]["budget_line"][0]["reference"]= "FF_Vietnam_Project";
            $tempVal[3]["budget_line"][0]["value"][0]["amount"]= 141276.85;
            $tempVal[3]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[3]["budget_line"][0]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[3]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund - Vietnam Pilot Project";
            $tempVal[3]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[3]["budget_line"][1]["reference"]= "FF_MA";
            $tempVal[3]["budget_line"][1]["value"][0]["amount"]= 5079901.9;
            $tempVal[3]["budget_line"][1]["value"][0]["currency"]= "GBP";
            $tempVal[3]["budget_line"][1]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[3]["budget_line"][1]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[3]["budget_line"][1]["narrative"][0]["language"]="";
            $tempVal[4]['recipient_country'][0]["code"]= "VN";
            $tempVal[4]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[4]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[4]["period_start"][0]["date"]= "2020-04-01";
            $tempVal[4]["period_end"][0]["date"]= "2021-03-31";
            $tempVal[4]["value"][0]["amount"]= 5063618.01;
            $tempVal[4]["value"][0]["currency"]= "GBP";
            $tempVal[4]["value"][0]["value_date"]= "2020-04-01";
            $tempVal[4]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[4]["budget_line"][0]["value"][0]["amount"]= 5063618.01;
            $tempVal[4]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[4]["budget_line"][0]["value"][0]["value_date"]= "2020-04-01";
            $tempVal[4]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[4]["budget_line"][0]["narrative"][0]["language"]= "";
            $tempVal[5]['recipient_country'][0]["code"]= "VN";
            $tempVal[5]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[5]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[5]["period_start"][0]["date"]= "2021-04-01";
            $tempVal[5]["period_end"][0]["date"]= "2022-03-31";
            $tempVal[5]["value"][0]["amount"]= 1849678.64;
            $tempVal[5]["value"][0]["currency"]= "GBP";
            $tempVal[5]["value"][0]["value_date"]= "2021-04-01";
            $tempVal[5]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[5]["budget_line"][0]["value"][0]["amount"]= 1849678.64;
            $tempVal[5]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[5]["budget_line"][0]["value"][0]["value_date"]= "2021-04-01";
            $tempVal[5]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[5]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[6]['recipient_country'][0]["code"]= "ZM";
            $tempVal[6]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[6]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[6]["period_start"][0]["date"]= "2018-04-01";
            $tempVal[6]["period_end"][0]["date"]= "2019-03-31";
            $tempVal[6]["value"][0]["amount"]= 5376;
            $tempVal[6]["value"][0]["currency"]= "GBP";
            $tempVal[6]["value"][0]["value_date"]= "2018-04-01";
            $tempVal[6]["budget_line"][0]["reference"]= "FF_CWPAMS";
            $tempVal[6]["budget_line"][0]["value"][0]["amount"]= 5376;
            $tempVal[6]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[6]["budget_line"][0]["value"][0]["value_date"]= "2018-04-01";
            $tempVal[6]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund - Commonwealth Partnerships for Antimicrobial Stewardship Scheme";
            $tempVal[6]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[7]['recipient_country'][0]["code"]= "ZM";
            $tempVal[7]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[7]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[7]["period_start"][0]["date"]= "2019-04-01";
            $tempVal[7]["period_end"][0]["date"]= "2020-03-31";
            $tempVal[7]["value"][0]["amount"]= 2530200.28;
            $tempVal[7]["value"][0]["currency"]= "GBP";
            $tempVal[7]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[7]["budget_line"][0]["reference"]= "FF_CWPAMS";
            $tempVal[7]["budget_line"][0]["value"][0]["amount"]= 56837;
            $tempVal[7]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[7]["budget_line"][0]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[7]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund - Commonwealth Partnerships for Antimicrobial Stewardship Scheme";
            $tempVal[7]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[7]["budget_line"][1]["reference"]= "FF_MA";
            $tempVal[7]["budget_line"][1]["value"][0]["amount"]= 2241363.28;
            $tempVal[7]["budget_line"][1]["value"][0]["currency"]= "GBP";
            $tempVal[7]["budget_line"][1]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[7]["budget_line"][1]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[7]["budget_line"][1]["narrative"][0]["language"]="";
            $tempVal[7]["budget_line"][2]["reference"]= "IHR-PHE";
            $tempVal[7]["budget_line"][2]["value"][0]["amount"]= 232000;
            $tempVal[7]["budget_line"][2]["value"][0]["currency"]= "GBP";
            $tempVal[7]["budget_line"][2]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[7]["budget_line"][2]["narrative"][0]["narrative"]= "International Health Regulations (IHR) Strengthening project";
            $tempVal[7]["budget_line"][2]["narrative"][0]["language"]="";
            $tempVal[8]['recipient_country'][0]["code"]= "ZM";
            $tempVal[8]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[8]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[8]["period_start"][0]["date"]= "2020-04-01";
            $tempVal[8]["period_end"][0]["date"]= "2021-03-31";
            $tempVal[8]["value"][0]["amount"]= 2894290.96;
            $tempVal[8]["value"][0]["currency"]= "GBP";
            $tempVal[8]["value"][0]["value_date"]= "2020-04-01";
            $tempVal[8]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[8]["budget_line"][0]["value"][0]["amount"]= 2894290.96;
            $tempVal[8]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[8]["budget_line"][0]["value"][0]["value_date"]= "2020-04-01";
            $tempVal[8]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[8]["budget_line"][0]["narrative"][0]["language"]= "";
            $tempVal[9]['recipient_country'][0]["code"]= "ZM";
            $tempVal[9]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[9]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[9]["period_start"][0]["date"]= "2021-04-01";
            $tempVal[9]["period_end"][0]["date"]= "2022-03-31";
            $tempVal[9]["value"][0]["amount"]= 1139728.85;
            $tempVal[9]["value"][0]["currency"]= "GBP";
            $tempVal[9]["value"][0]["value_date"]= "2021-04-01";
            $tempVal[9]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[9]["budget_line"][0]["value"][0]["amount"]= 1139728.85;
            $tempVal[9]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[9]["budget_line"][0]["value"][0]["value_date"]= "2021-04-01";
            $tempVal[9]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[9]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[10]['recipient_country'][0]["code"]= "ZW";
            $tempVal[10]['recipient_country'][0]["narrative"][0]["narrative"]=""; 
            $tempVal[10]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[10]["period_start"][0]["date"]= "2019-04-01";
            $tempVal[10]["period_end"][0]["date"]= "2020-03-31";
            $tempVal[10]["value"][0]["amount"]= 1025660.67;
            $tempVal[10]["value"][0]["currency"]= "GBP";
            $tempVal[10]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[10]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[10]["budget_line"][0]["value"][0]["amount"]= 1025660.67;
            $tempVal[10]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[10]["budget_line"][0]["value"][0]["value_date"]= "2019-04-01";
            $tempVal[10]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[10]["budget_line"][0]["narrative"][0]["language"]= "";
            $tempVal[11]['recipient_country'][0]["code"]= "ZW";
            $tempVal[11]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[11]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[11]["period_start"][0]["date"]= "2020-04-01";
            $tempVal[11]["period_end"][0]["date"]= "2021-03-31";
            $tempVal[11]["value"][0]["amount"]= 3125147.12;
            $tempVal[11]["value"][0]["currency"]= "GBP";
            $tempVal[11]["value"][0]["value_date"]= "2020-04-01";
            $tempVal[11]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[11]["budget_line"][0]["value"][0]["amount"]= 3125147.12;
            $tempVal[11]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[11]["budget_line"][0]["value"][0]["value_date"]= "2020-04-01";
            $tempVal[11]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[11]["budget_line"][0]["narrative"][0]["language"]="";
            $tempVal[12]['recipient_country'][0]["code"]= "ZW";
            $tempVal[12]['recipient_country'][0]["narrative"][0]["narrative"]= "";
            $tempVal[12]['recipient_country'][0]["narrative"][0]["language"]= "";
            $tempVal[12]["period_start"][0]["date"]= "2021-04-01";
            $tempVal[12]["period_end"][0]["date"]= "2022-03-31";
            $tempVal[12]["value"][0]["amount"]= 1693895.51;
            $tempVal[12]["value"][0]["currency"]= "GBP";
            $tempVal[12]["value"][0]["value_date"]= "2021-04-01";
            $tempVal[12]["budget_line"][0]["reference"]= "FF_MA";
            $tempVal[12]["budget_line"][0]["value"][0]["amount"]= 1693895.51; 
            $tempVal[12]["budget_line"][0]["value"][0]["currency"]= "GBP";
            $tempVal[12]["budget_line"][0]["value"][0]["value_date"]= "2021-04-01";
            $tempVal[12]["budget_line"][0]["narrative"][0]["narrative"]= "Fleming Fund – Country and Regional Grants and Fellowships Programme";
            $tempVal[12]["budget_line"][0]["narrative"][0]["language"]= "";
            foreach($tempVal as $x){
                array_push($input['recipient_country_budget'], $x);
            }
        }
        $organization->recipient_country_budget = $input['recipient_country_budget'];
        return $organization->save();
    }

    /**
     * write brief description
     * @param $organization_id
     * @return model
     */
    public function getOrganizationData($organization_id)
    {
        return $this->org->where('id', $organization_id)->first();
    }

    /**
     * write brief description
     * @param $organization_id
     * @return model
     */
    public function getRecipientCountryBudgetData($organization_id)
    {
        return $this->org->where('id', $organization_id)->first()->recipient_country_budget;
    }
}
