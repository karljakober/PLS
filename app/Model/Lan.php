<?php
App::uses('AppModel', 'Model');
/**
 * Lan Model
 *
 * @property Server $Server
 * @property Tournament $Tournament
 */
class Lan extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Server' => array(
			'className' => 'Server',
			'foreignKey' => 'lan_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Tournament' => array(
			'className' => 'Tournament',
			'foreignKey' => 'lan_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	public function active($upcoming = false) {
		if ($upcoming) {
            $curLan = $this->find('first', array(
            'conditions' => array(
               'CURDATE() < Lan.end_time')));
        } else {
            $curLan = $this->find('first', array(
            'conditions' => array(
               'CURDATE() between Lan.start_time and Lan.end_time')));
        }
        

		return $curLan;

	}

    public function lanActive($id) {
        $lan = $this->findById($id);
        if ($lan['Lan']['end_time'] < date(time())) {
            return false;
        }
        return true;
    }

	public function getTimelineJson() {
		$data = array(
			'timeline' => array(
				'headline' => 'The Main Timeline Headline Goes here',
				'type' => 'default',
				'text' => '<p>Intro body text goes here, some HTML is ok</p>',
				'asset' => array(
					'media' => 'http://yourdomain_or_socialmedialink_goes_here.jpg',
					'credit' => 'Credit Name',
					'caption' => 'caption'
				),
				"date" => array(array(
	                "startDate" => "2011,12,10",
	                "endDate" => "2011,12,11",
	                "headline" => "Headline Goes Here",
	                "text" => "<p>Body text goes here, some HTML is OK</p>",
	                "tag" => "This is Optional",
	                "classname" => "optionaluniqueclassnamecanbeaddedhere",
	                "asset" => array(
	                    "media" => "http://twitter.com/ArjunaSoriano/status/164181156147900416",
	                    "thumbnail" => "optional-32x32px.jpg",
	                    "credit" => "Credit Name Goes Here",
	                    "caption" => "Caption text goes here"
	                )
	            )),
		        "era" => array(array(
	                "startDate" => "2011,12,10",
	                "endDate" => "2011,12,11",
	                "headline" => "Headline Goes Here",
	                "text" => "<p>Body text goes here, some HTML is OK</p>",
	                "tag" => "This is Optional"
		        ))
		    ));
		//return $data;
echo '
{
    "timeline":
    {
        "headline":"Sh*t People Say",
        "type":"default",
"text":"People say stuff",
"startDate":"2012,1,26",
        "date": [
            {
                "startDate":"2012,1,26",
"endDate":"2012,1,27",
                "headline":"Sh*t Politicians Say",
                "text":"<p>In true political fashion, his character rattles off common jargon heard from people running for office.</p>",
                "asset":
                {
                    "media":"http://youtu.be/u4XpeU9erbg",
                    "credit":"",
                    "caption":""
                }
            },
            {
                "startDate":"2012,1,10",
                "headline":"Sh*t Nobody Says",
                "text":"<p>Have you ever heard someone say “can I burn a copy of your Nickelback CD?” or “my Bazooka gum still has flavor!” Nobody says that.</p>",
                "asset":
                {
                    "media":"http://youtu.be/f-x8t0JOnVw",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,26",
                "headline":"Sh*t Chicagoans Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/Ofy5gNkKGOo",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2011,12,12",
                "headline":"Sh*t Girls Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/u-yLGIH7W9Y",
                    "credit":"",
                    "caption":"Writers & Creators: Kyle Humphrey & Graydon Sheppard"
                }
            },
{
                "startDate":"2012,1,4",
                "headline":"Sh*t Broke People Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/zyyalkHjSjo",
                    "credit":"",
                    "caption":""
                }
            },

{
                "startDate":"2012,1,4",
                "headline":"Sh*t Silicon Valley Says",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/BR8zFANeBGQ",
                    "credit":"",
                    "caption":"written, filmed, and edited by Kate Imbach & Tom Conrad"
                }
            },
{
                "startDate":"2011,12,25",
                "headline":"Sh*t Vegans Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/OmWFnd-p0Lw",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,23",
                "headline":"Sh*t Graphic Designers Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/KsT3QTmsN5Q",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2011,12,30",
                "headline":"Sh*t Wookiees Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/vJpBCzzcSgA",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,17",
                "headline":"Sh*t People Say About Sh*t People Say Videos",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/c9ehQ7vO7c0",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,20",
                "headline":"Sh*t Social Media Pros Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/eRQe-BT9g_U",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,11",
                "headline":"Sh*t Old People Say About Computers",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/HRmc5uuoUzA",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,11",
                "headline":"Sh*t College Freshmen Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/rwozXzo0MZk",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2011,12,16",
                "headline":"Sh*t Girls Say - Episode 2",
                "text":"",
                "asset":
                {
                    "media":"/tournaments/",
                    "credit":"",
                    "caption":"Writers & Creators: Kyle Humphrey & Graydon Sheppard"
                }
            },
{
                "startDate":"2011,12,24",
                "headline":"Sh*t Girls Say - Episode 3 Featuring Juliette Lewis",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/bDHUhT71JN8",
                    "credit":"",
                    "caption":"Writers & Creators: Kyle Humphrey & Graydon Sheppard"
                }
            },
{
                "startDate":"2012,1,27",
                "headline":"Sh*t Web Designers Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/MEOb_meSHhQ",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,12",
                "headline":"Sh*t Hipsters Say",
                "text":"No meme is complete without a bit of hipster-bashing.",
                "asset":
                {
                    "media":"http://youtu.be/FUhrSVyu0Kw",
                    "credit":"",
                    "caption":"Written, Directed, Conceptualized and Performed by Carrie Valentine and Jessica Katz"
                }
            },
{
                "startDate":"2012,1,6",
                "headline":"Sh*t Cats Say",
                "text":"No meme is complete without cats. This had to happen, obviously.",
                "asset":
                {
                    "media":"http://youtu.be/MUX58Vi-YLg",
                    "credit":"",
                    "caption":""
                }
            },
{
                "startDate":"2012,1,21",
                "headline":"Sh*t Cyclists Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/GMCkuqL9IcM",
                    "credit":"",
                    "caption":"Video script, production, and editing by Allen Krughoff of Hardcastle Photography"
                }
            },
{
                "startDate":"2011,12,30",
                "headline":"Sh*t Yogis Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/IMC1_RH_b3k",
                    "credit":"",
                    "caption":""
                }
            },




{
                "startDate":"2012,1,18",
                "headline":"Sh*t New Yorkers Say",
                "text":"",
                "asset":
                {
                    "media":"http://youtu.be/yRvJylbSg7o",
                    "credit":"",
                    "caption":"Directed and Edited by Matt Mayer, Produced by Seth Keim, Written by Eliot Glazer. Featuring Eliot and Ilana Glazer, who are siblings, not married."
                }
            }
        ]
    }
}';
exit();
	}

}
