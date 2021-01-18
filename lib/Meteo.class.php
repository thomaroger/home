<?php
class Meteo 
{
	private $OUTPUT_FORMAT;
	private $XML_COMMENT;
	private $DATA = array();
	private $HEADER = array();
	private $UPDATE;
	private $METEO_XML_DATA_URL;	// Métropole
	private $DOM;
	private $RISQUE = array("","vent","pluie inondation","orages","inondations","neige verglas","canicule","grand froid","avalanches","vagues submersion","crues");
	private $DEP;
	private $COLORS = array(2=>'alert-warning', 3=>"alert-orange", 4=>"alert-danger");
	private $PICTS = array("Soyez prudents" => "exclamation-triangle","vent" =>'wind' ,"pluie inondation" => 'cloud-showers-heavy',"orages" => 'bolt' ,"inondations" => 'water' ,"neige verglas" => 'snowflake' ,"canicule" => 'temperature-high' ,"grand froid" => 'temperature-low' ,"avalanches" => 'snowflake',"vagues submersion" => 'water' ,"crues" => 'water');
		
	public function __construct()
	{
		$this->METEO_XML_DATA_URL = "http://www.vigimeteo.com/data/NXFR34_LFPW_.xml";
		if(getenv('ENV') == 'dev') {
			$this->METEO_XML_DATA_URL = "/Users/troger/Downloads/NXFR34_LFPW_.xml";
		}

		$update = $this->ToUTF8("update");
		$updateval = $this->ToUTF8(date("d-m-Y H:i"));
		$this->UPDATE[$update] = $updateval;
	}
	
    private function GetData($url)
	{
		return file_get_contents($url);
	}
	
	public function DonneesVigilance($file = false)
	{
		$this->MetropoleDataFormat();
		
		$this->SortAndMergeHeaderAndData();
		$root = $this->ToUTF8("vigilance");
		$arr = $this->DATA;
		$this->DATA = array();
		$this->DATA[$root] = $arr;
		return $this->format();		
	}
	
	private function SortAndMergeHeaderAndData()
	{
		// Fusion des tableaux entete et données après tri du tableau des données
		$this->DataSort();
		$this->DATA = (array_merge($this->UPDATE,$this->HEADER,$this->DATA));
	}
	
	private function CreateHeader($location,$data)
	{
		$this->CreateMetropoleHeader($data);
	}
	
	private function CreateMetropoleHeader($array_data)
	{
		$label = $this->ToUTF8("bulletin_metropole");
		$this->HEADER[$label] = array(
									$this->ToUTF8("creation") => $this->ToUTF8($this->ConvertLongDateToFRDate($array_data['dateinsert'])),
									$this->ToUTF8("mise_a_jour") => $this->ToUTF8($this->ConvertLongDateToFRDate($array_data['daterun'])),
									$this->ToUTF8("validite") => $this->ToUTF8($this->ConvertLongDateToFRDate($array_data['dateprevue'])),
									$this->ToUTF8("version") => $this->ToUTF8($array_data['noversion'])
									);
	}
	
	private function ConvertLongDateToFRDate($str)
	{
		// Date au format YYYYMMDDHHMMSS
		$year = substr($str,0,4);
		$month = substr($str,4,2);
		$day = substr($str,6,2);
		$hour = substr($str,8,2);
		$min = substr($str,10,2);
				
		return $day."/".$month."/".$year." ".$hour."h".$min;
	}
	
	private function MetropoleDataFormat()
	{
		// Lit et met en forme les données pour le format de sortie
		$xml = new SimpleXMLElement($this->GetData($this->METEO_XML_DATA_URL));
		
		foreach ($xml->datavigilance as $line)
		{	
			$this->DEP = $this->ToUTF8("dep_".$line['dep']);
			$this->AddData($line);
		}
		$this->CreateHeader("metropole",$xml->entetevigilance);
	}
	
	private function AddData($data)
	{
		if($this->DEP != 'dep_91' && $this->DEP != 'dep_77')  {
			return;
		}
		$NiveauMax = $this->NiveauMax($data);

		if (!isset($this->DATA[$this->DEP]["risque"]))
			$this->DATA[$this->DEP]["risque"] = "";
		
		if ($NiveauMax > 2) 
		{
			$risque = $this->RisqueConcat($data->risque["valeur"]);
			if ((isset ($data->crue["valeur"])) && (((int)$data->crue["valeur"]) > 2))
				$risque = $this->RisqueConcat(10, $risque);
		}
		elseif ($NiveauMax == 2)
			$risque = "Soyez prudents"; 
			else
				$risque = "RAS"; 
		
		if ((isset ($data->crue["valeur"])) && ($data->crue["valeur"]) > 0)
			$this->DATA[$this->DEP] = array (
							$this->ToUTF8("niveau") => $this->ToUTF8($NiveauMax), 
							$this->ToUTF8("alerte") => $this->ToUTF8($this->ConvertLevelToColor($NiveauMax)),
							$this->ToUTF8("risque") => $this->ToUTF8($risque),
							$this->ToUTF8("crues")	=> $this->ToUTF8($data->crue["valeur"])
									);
		else
			$this->DATA[$this->DEP] = array (
							$this->ToUTF8("niveau") => $this->ToUTF8($NiveauMax), 
							$this->ToUTF8("alerte") => $this->ToUTF8($this->ConvertLevelToColor($NiveauMax)),
							$this->ToUTF8("risque") => $this->ToUTF8($risque),
									);
	}
	
	private function NiveauMax($data)
	{
		((int)$data['couleur'] >= (int)$data->crue['valeur']) ? $niveau = $data['couleur'] : $niveau = $data->crue['valeur'];
		return $niveau;
	}
	
	private function RisqueConcat($risque,$risque_text = "")
	{
		if (($risque_libelle = $this->RisqueConvert($risque)) != "")
		{
			if (strlen($risque_text) > 0)
				$risque_text .= ", ".($risque_libelle);
			else
				$risque_text = ($risque_libelle);
		}
		return $risque_text;
	}
	
	private function RisqueConvert($risque)
	{
		$risque = (int)$risque;
		return $this->RISQUE[$risque];
	}
	
	
	private function ToUTF8($str)
	{
		return utf8_encode($str);
	}
	
	private function ConvertLevelToColor($level)
	{
		$level = (int)$level;
		$colors = array('Bleu','Vert','Jaune','Orange','Rouge','Violet','Gris');
		return $colors[$level];
	}
	
	private function ConvertColorToLevel($color)
	{
		$color = strtolower($color);
		$level = array('bleu' => 0,'vert' => 1,'jaune' => 2,'orange' => 3,'rouge' => 4,'violet' => 5,'gris' => 6);
		return $level[$color];
	}
	
	private function DataSort()
	{
		ksort($this->DATA);
	}

	private function format() {
		$vigilance = array();


		if($this->DATA['vigilance']['dep_77']) {
			if($this->DATA['vigilance']['dep_77']['risque'] != 'RAS') {
				$vigilance[0]['title'] = $this->DATA['vigilance']['dep_77']['risque'];
				$vigilance[0]['type'] = 'Vigilance '.$this->DATA['vigilance']['dep_77']['alerte'];
				$vigilance[0]['dep'] = 'Seine et Marne (77)';
				$vigilance[0]['color'] = $this->COLORS[$this->DATA['vigilance']['dep_77']['niveau']];
				$vigilance[0]['pict'] = $this->PICTS[$this->DATA['vigilance']['dep_77']['risque']];
				$vigilance[0]['date'] = 'du '.$this->DATA['vigilance']['bulletin_metropole']['creation'].' au '.$this->DATA['vigilance']['bulletin_metropole']['validite'];
			}

		}

		if($this->DATA['vigilance']['dep_91']) {
			if($this->DATA['vigilance']['dep_91']['risque'] != 'RAS') {
				if ($this->DATA['vigilance']['dep_77']['alerte'] == $this->DATA['vigilance']['dep_91']['alerte']) {
					$vigilance[0]['dep'] = 'Essonnes (91), Seine et Marne (77)';
				} else {
					$vigilance[1]['title'] = $this->DATA['vigilance']['dep_91']['risque'];;
					$vigilance[1]['type'] = 'Vigilance '.$this->DATA['vigilance']['dep_91']['alerte'];
					$vigilance[1]['dep'] = 'Essonnes (91)';
					$vigilance[1]['color'] = $this->COLORS[$this->DATA['vigilance']['dep_91']['niveau']];
					$vigilance[1]['date'] = 'du '.$this->DATA['vigilance']['bulletin_metropole']['creation'].' au '.$this->DATA['vigilance']['bulletin_metropole']['validite'];
					$vigilance[1]['pict'] = $this->PICTS[$this->DATA['vigilance']['dep_91']['risque']];

				}
			}
		}

		return $vigilance;
	}


	public function render()
	{
		$vigilances = $this->DonneesVigilance();
		$html = "";
		if(empty($vigilances)) {
			return $html;
		}

		foreach ($vigilances as $vigilance) {
			$html .= '<div class="row"><div class="col-md-12 themed-grid-col">';
			$html .= '<div class="alert '.$vigilance['color'].'" role="alert">';
			$html .= '<div class="row"><div class="col-md-8 themed-grid-col">';
			$html .= '<h4 class="alert-heading">'.ucfirst($vigilance['title']).'</h4>';
			$html .= '<p>'.$vigilance['type'].'<br />'.$vigilance['dep'].'<br />'.$vigilance['date'].'</p></div>';
			$html .= '<div class="col-md-4 themed-grid-col text-center"><p>';
			$html .= '<i class="fas fa-'. $vigilance['pict'].' fa-7x"></i></p>';
			$html .= '</div></div></div></div></div>';
		}
		
		return $html;
	}

}

?>
