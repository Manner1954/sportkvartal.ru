<?php
//============================================================+
// File name   : encodings_maps.php
// Version     : 1.0.001
// Begin       : 2011-10-01
// Last Update : 2011-11-15
// Author      : Nicola Asuni - Tecnick.com LTD - Manor Coach House, Church Hill, Aldershot, Hants, GU12 4RQ, UK - www.tecnick.com - info@tecnick.com
// License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
// -------------------------------------------------------------------
// Copyright (C) 2008-2012  Nicola Asuni - Tecnick.com LTD
//
// This file is part of TCPDF software library.
//
// TCPDF is free software: you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// TCPDF is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with TCPDF.  If not, see <http://www.gnu.org/licenses/>.
//
// See LICENSE.TXT file for more information.
// -------------------------------------------------------------------
//
// Description : Unicode data for TCPDF library.
//
//============================================================+

/**
 * @file
 * Font encodings maps class for TCPDF library.
 * @author Nicola Asuni
 * @package com.tecnick.tcpdf
 * @since 5.9.123 (2011-10-01)
 */

/**
 * @class TCPDF_ENCODING_MAPS
 * This is a PHP class containing Font encodings maps class for TCPDF library.
 * @package com.tecnick.tcpdf
 * @version 1.0.000
 * @author Nicola Asuni - info@tecnick.com
 */
class TCPDF_ENCODING_MAPS {

/**
 * Array of Encoding Maps.
 * @public
 */
public $encmap = array(

// encoding map for: koi8-r
'koi8-r' => array(0=>'.notdef',1=>'.notdef',2=>'.notdef',3=>'.notdef',4=>'.notdef',5=>'.notdef',6=>'.notdef',7=>'.notdef',
8=>'.notdef',9=>'.notdef',10=>'.notdef',11=>'.notdef',12=>'.notdef',13=>'.notdef',14=>'.notdef',15=>'.notdef',
16=>'.notdef',17=>'.notdef',18=>'.notdef',19=>'.notdef',20=>'.notdef',21=>'.notdef',22=>'.notdef',23=>'.notdef',
24=>'.notdef',25=>'.notdef',26=>'.notdef',27=>'.notdef',28=>'.notdef',29=>'.notdef',30=>'.notdef',31=>'.notdef',
32=>'space',33=>'exclam',34=>'quotedbl',35=>'numbersign',36=>'dollar',37=>'percent',38=>'ampersand',39=>'quotesingle',
40=>'parenleft',41=>'parenright',42=>'asterisk',43=>'plus',44=>'comma',45=>'hyphen',46=>'period',47=>'slash',
48=>'zero',49=>'one',50=>'two',51=>'three',52=>'four',53=>'five',54=>'six',55=>'seven',
56=>'eight',57=>'nine',58=>'colon',59=>'semicolon',60=>'less',61=>'equal',62=>'greater',63=>'question',
64=>'at',65=>'A',66=>'B',67=>'C',68=>'D',69=>'E',70=>'F',71=>'G',
72=>'H',73=>'I',74=>'J',75=>'K',76=>'L',77=>'M',78=>'N',79=>'O',
80=>'P',81=>'Q',82=>'R',83=>'S',84=>'T',85=>'U',86=>'V',87=>'W',
88=>'X',89=>'Y',90=>'Z',91=>'bracketleft',92=>'backslash',93=>'bracketright',94=>'asciicircum',95=>'underscore',
96=>'grave',97=>'a',98=>'b',99=>'c',100=>'d',101=>'e',102=>'f',103=>'g',
104=>'h',105=>'i',106=>'j',107=>'k',108=>'l',109=>'m',110=>'n',111=>'o',
112=>'p',113=>'q',114=>'r',115=>'s',116=>'t',117=>'u',118=>'v',119=>'w',
120=>'x',121=>'y',122=>'z',123=>'braceleft',124=>'bar',125=>'braceright',126=>'asciitilde',127=>'.notdef',
128=>'SF100000',129=>'SF110000',130=>'SF010000',131=>'SF030000',132=>'SF020000',133=>'SF040000',134=>'SF080000',135=>'SF090000',
136=>'SF060000',137=>'SF070000',138=>'SF050000',139=>'upblock',140=>'dnblock',141=>'block',142=>'lfblock',143=>'rtblock',
144=>'ltshade',145=>'shade',146=>'dkshade',147=>'integraltp',148=>'filledbox',149=>'periodcentered',150=>'radical',151=>'approxequal',
152=>'lessequal',153=>'greaterequal',154=>'space',155=>'integralbt',156=>'degree',157=>'twosuperior',158=>'periodcentered',159=>'divide',
160=>'SF430000',161=>'SF240000',162=>'SF510000',163=>'afii10071',164=>'SF520000',165=>'SF390000',166=>'SF220000',167=>'SF210000',
168=>'SF250000',169=>'SF500000',170=>'SF490000',171=>'SF380000',172=>'SF280000',173=>'SF270000',174=>'SF260000',175=>'SF360000',
176=>'SF370000',177=>'SF420000',178=>'SF190000',179=>'afii10023',180=>'SF200000',181=>'SF230000',182=>'SF470000',183=>'SF480000',
184=>'SF410000',185=>'SF450000',186=>'SF460000',187=>'SF400000',188=>'SF540000',189=>'SF530000',190=>'SF440000',191=>'copyright',
192=>'afii10096',193=>'afii10065',194=>'afii10066',195=>'afii10088',196=>'afii10069',197=>'afii10070',198=>'afii10086',199=>'afii10068',
200=>'afii10087',201=>'afii10074',202=>'afii10075',203=>'afii10076',204=>'afii10077',205=>'afii10078',206=>'afii10079',207=>'afii10080',
208=>'afii10081',209=>'afii10097',210=>'afii10082',211=>'afii10083',212=>'afii10084',213=>'afii10085',214=>'afii10072',215=>'afii10067',
216=>'afii10094',217=>'afii10093',218=>'afii10073',219=>'afii10090',220=>'afii10095',221=>'afii10091',222=>'afii10089',223=>'afii10092',
224=>'afii10048',225=>'afii10017',226=>'afii10018',227=>'afii10040',228=>'afii10021',229=>'afii10022',230=>'afii10038',231=>'afii10020',
232=>'afii10039',233=>'afii10026',234=>'afii10027',235=>'afii10028',236=>'afii10029',237=>'afii10030',238=>'afii10031',239=>'afii10032',
240=>'afii10033',241=>'afii10049',242=>'afii10034',243=>'afii10035',244=>'afii10036',245=>'afii10037',246=>'afii10024',247=>'afii10019',
248=>'afii10046',249=>'afii10045',250=>'afii10025',251=>'afii10042',252=>'afii10047',253=>'afii10043',254=>'afii10041',255=>'afii10044'),

// encoding map for: koi8-r
'koi8-r' => array(0=>'.notdef',1=>'.notdef',2=>'.notdef',3=>'.notdef',4=>'.notdef',5=>'.notdef',6=>'.notdef',7=>'.notdef',
8=>'.notdef',9=>'.notdef',10=>'.notdef',11=>'.notdef',12=>'.notdef',13=>'.notdef',14=>'.notdef',15=>'.notdef',
16=>'.notdef',17=>'.notdef',18=>'.notdef',19=>'.notdef',20=>'.notdef',21=>'.notdef',22=>'.notdef',23=>'.notdef',
24=>'.notdef',25=>'.notdef',26=>'.notdef',27=>'.notdef',28=>'.notdef',29=>'.notdef',30=>'.notdef',31=>'.notdef',
32=>'space',33=>'exclam',34=>'quotedbl',35=>'numbersign',36=>'dollar',37=>'percent',38=>'ampersand',39=>'quotesingle',
40=>'parenleft',41=>'parenright',42=>'asterisk',43=>'plus',44=>'comma',45=>'hyphen',46=>'period',47=>'slash',
48=>'zero',49=>'one',50=>'two',51=>'three',52=>'four',53=>'five',54=>'six',55=>'seven',
56=>'eight',57=>'nine',58=>'colon',59=>'semicolon',60=>'less',61=>'equal',62=>'greater',63=>'question',
64=>'at',65=>'A',66=>'B',67=>'C',68=>'D',69=>'E',70=>'F',71=>'G',
72=>'H',73=>'I',74=>'J',75=>'K',76=>'L',77=>'M',78=>'N',79=>'O',
80=>'P',81=>'Q',82=>'R',83=>'S',84=>'T',85=>'U',86=>'V',87=>'W',
88=>'X',89=>'Y',90=>'Z',91=>'bracketleft',92=>'backslash',93=>'bracketright',94=>'asciicircum',95=>'underscore',
96=>'grave',97=>'a',98=>'b',99=>'c',100=>'d',101=>'e',102=>'f',103=>'g',
104=>'h',105=>'i',106=>'j',107=>'k',108=>'l',109=>'m',110=>'n',111=>'o',
112=>'p',113=>'q',114=>'r',115=>'s',116=>'t',117=>'u',118=>'v',119=>'w',
120=>'x',121=>'y',122=>'z',123=>'braceleft',124=>'bar',125=>'braceright',126=>'asciitilde',127=>'.notdef',
128=>'SF100000',129=>'SF110000',130=>'SF010000',131=>'SF030000',132=>'SF020000',133=>'SF040000',134=>'SF080000',135=>'SF090000',
136=>'SF060000',137=>'SF070000',138=>'SF050000',139=>'upblock',140=>'dnblock',141=>'block',142=>'lfblock',143=>'rtblock',
144=>'ltshade',145=>'shade',146=>'dkshade',147=>'integraltp',148=>'filledbox',149=>'periodcentered',150=>'radical',151=>'approxequal',
152=>'lessequal',153=>'greaterequal',154=>'space',155=>'integralbt',156=>'degree',157=>'twosuperior',158=>'periodcentered',159=>'divide',
160=>'SF430000',161=>'SF240000',162=>'SF510000',163=>'afii10071',164=>'SF520000',165=>'SF390000',166=>'SF220000',167=>'SF210000',
168=>'SF250000',169=>'SF500000',170=>'SF490000',171=>'SF380000',172=>'SF280000',173=>'SF270000',174=>'SF260000',175=>'SF360000',
176=>'SF370000',177=>'SF420000',178=>'SF190000',179=>'afii10023',180=>'SF200000',181=>'SF230000',182=>'SF470000',183=>'SF480000',
184=>'SF410000',185=>'SF450000',186=>'SF460000',187=>'SF400000',188=>'SF540000',189=>'SF530000',190=>'SF440000',191=>'copyright',
192=>'afii10096',193=>'afii10065',194=>'afii10066',195=>'afii10088',196=>'afii10069',197=>'afii10070',198=>'afii10086',199=>'afii10068',
200=>'afii10087',201=>'afii10074',202=>'afii10075',203=>'afii10076',204=>'afii10077',205=>'afii10078',206=>'afii10079',207=>'afii10080',
208=>'afii10081',209=>'afii10097',210=>'afii10082',211=>'afii10083',212=>'afii10084',213=>'afii10085',214=>'afii10072',215=>'afii10067',
216=>'afii10094',217=>'afii10093',218=>'afii10073',219=>'afii10090',220=>'afii10095',221=>'afii10091',222=>'afii10089',223=>'afii10092',
224=>'afii10048',225=>'afii10017',226=>'afii10018',227=>'afii10040',228=>'afii10021',229=>'afii10022',230=>'afii10038',231=>'afii10020',
232=>'afii10039',233=>'afii10026',234=>'afii10027',235=>'afii10028',236=>'afii10029',237=>'afii10030',238=>'afii10031',239=>'afii10032',
240=>'afii10033',241=>'afii10049',242=>'afii10034',243=>'afii10035',244=>'afii10036',245=>'afii10037',246=>'afii10024',247=>'afii10019',
248=>'afii10046',249=>'afii10045',250=>'afii10025',251=>'afii10042',252=>'afii10047',253=>'afii10043',254=>'afii10041',255=>'afii10044'),

// encoding map for: koi8-u
'koi8-u' => array(0=>'.notdef',1=>'.notdef',2=>'.notdef',3=>'.notdef',4=>'.notdef',5=>'.notdef',6=>'.notdef',7=>'.notdef',
8=>'.notdef',9=>'.notdef',10=>'.notdef',11=>'.notdef',12=>'.notdef',13=>'.notdef',14=>'.notdef',15=>'.notdef',
16=>'.notdef',17=>'.notdef',18=>'.notdef',19=>'.notdef',20=>'.notdef',21=>'.notdef',22=>'.notdef',23=>'.notdef',
24=>'.notdef',25=>'.notdef',26=>'.notdef',27=>'.notdef',28=>'.notdef',29=>'.notdef',30=>'.notdef',31=>'.notdef',
32=>'space',33=>'exclam',34=>'quotedbl',35=>'numbersign',36=>'dollar',37=>'percent',38=>'ampersand',39=>'quotesingle',
40=>'parenleft',41=>'parenright',42=>'asterisk',43=>'plus',44=>'comma',45=>'hyphen',46=>'period',47=>'slash',
48=>'zero',49=>'one',50=>'two',51=>'three',52=>'four',53=>'five',54=>'six',55=>'seven',
56=>'eight',57=>'nine',58=>'colon',59=>'semicolon',60=>'less',61=>'equal',62=>'greater',63=>'question',
64=>'at',65=>'A',66=>'B',67=>'C',68=>'D',69=>'E',70=>'F',71=>'G',
72=>'H',73=>'I',74=>'J',75=>'K',76=>'L',77=>'M',78=>'N',79=>'O',
80=>'P',81=>'Q',82=>'R',83=>'S',84=>'T',85=>'U',86=>'V',87=>'W',
88=>'X',89=>'Y',90=>'Z',91=>'bracketleft',92=>'backslash',93=>'bracketright',94=>'asciicircum',95=>'underscore',
96=>'grave',97=>'a',98=>'b',99=>'c',100=>'d',101=>'e',102=>'f',103=>'g',
104=>'h',105=>'i',106=>'j',107=>'k',108=>'l',109=>'m',110=>'n',111=>'o',
112=>'p',113=>'q',114=>'r',115=>'s',116=>'t',117=>'u',118=>'v',119=>'w',
120=>'x',121=>'y',122=>'z',123=>'braceleft',124=>'bar',125=>'braceright',126=>'asciitilde',127=>'.notdef',
128=>'SF100000',129=>'SF110000',130=>'SF010000',131=>'SF030000',132=>'SF020000',133=>'SF040000',134=>'SF080000',135=>'SF090000',
136=>'SF060000',137=>'SF070000',138=>'SF050000',139=>'upblock',140=>'dnblock',141=>'block',142=>'lfblock',143=>'rtblock',
144=>'ltshade',145=>'shade',146=>'dkshade',147=>'integraltp',148=>'filledbox',149=>'bullet',150=>'radical',151=>'approxequal',
152=>'lessequal',153=>'greaterequal',154=>'space',155=>'integralbt',156=>'degree',157=>'twosuperior',158=>'periodcentered',159=>'divide',
160=>'SF430000',161=>'SF240000',162=>'SF510000',163=>'afii10071',164=>'afii10101',165=>'SF390000',166=>'afii10103',167=>'afii10104',
168=>'SF250000',169=>'SF500000',170=>'SF490000',171=>'SF380000',172=>'SF280000',173=>'afii10098',174=>'SF260000',175=>'SF360000',
176=>'SF370000',177=>'SF420000',178=>'SF190000',179=>'afii10023',180=>'afii10053',181=>'SF230000',182=>'afii10055',183=>'afii10056',
184=>'SF410000',185=>'SF450000',186=>'SF460000',187=>'SF400000',188=>'SF540000',189=>'afii10050',190=>'SF440000',191=>'copyright',
192=>'afii10096',193=>'afii10065',194=>'afii10066',195=>'afii10088',196=>'afii10069',197=>'afii10070',198=>'afii10086',199=>'afii10068',
200=>'afii10087',201=>'afii10074',202=>'afii10075',203=>'afii10076',204=>'afii10077',205=>'afii10078',206=>'afii10079',207=>'afii10080',
208=>'afii10081',209=>'afii10097',210=>'afii10082',211=>'afii10083',212=>'afii10084',213=>'afii10085',214=>'afii10072',215=>'afii10067',
216=>'afii10094',217=>'afii10093',218=>'afii10073',219=>'afii10090',220=>'afii10095',221=>'afii10091',222=>'afii10089',223=>'afii10092',
224=>'afii10048',225=>'afii10017',226=>'afii10018',227=>'afii10040',228=>'afii10021',229=>'afii10022',230=>'afii10038',231=>'afii10020',
232=>'afii10039',233=>'afii10026',234=>'afii10027',235=>'afii10028',236=>'afii10029',237=>'afii10030',238=>'afii10031',239=>'afii10032',
240=>'afii10033',241=>'afii10049',242=>'afii10034',243=>'afii10035',244=>'afii10036',245=>'afii10037',246=>'afii10024',247=>'afii10019',
248=>'afii10046',249=>'afii10045',250=>'afii10025',251=>'afii10042',252=>'afii10047',253=>'afii10043',254=>'afii10041',255=>'afii10044'),

// encoding map for: symbol
'symbol' => array(0=>'.notdef',1=>'.notdef',2=>'.notdef',3=>'.notdef',4=>'.notdef',5=>'.notdef',6=>'.notdef',7=>'.notdef',
8=>'.notdef',9=>'.notdef',10=>'.notdef',11=>'.notdef',12=>'.notdef',13=>'.notdef',14=>'.notdef',15=>'.notdef',
16=>'.notdef',17=>'.notdef',18=>'.notdef',19=>'.notdef',20=>'.notdef',21=>'.notdef',22=>'.notdef',23=>'.notdef',
24=>'.notdef',25=>'.notdef',26=>'.notdef',27=>'.notdef',28=>'.notdef',29=>'.notdef',30=>'.notdef',31=>'.notdef',
32=>'space',33=>'exclam',34=>'universal',35=>'numbersign',36=>'existential',37=>'percent',38=>'ampersand',39=>'suchthat',
40=>'parenleft',41=>'parenright',42=>'asteriskmath',43=>'plus',44=>'comma',45=>'minus',46=>'period',47=>'slash',
48=>'zero',49=>'one',50=>'two',51=>'three',52=>'four',53=>'five',54=>'six',55=>'seven',
56=>'eight',57=>'nine',58=>'colon',59=>'semicolon',60=>'less',61=>'equal',62=>'greater',63=>'question',
64=>'congruent',65=>'Alpha',66=>'Beta',67=>'Chi',68=>'Delta',69=>'Epsilon',70=>'Phi',71=>'Gamma',
72=>'Eta',73=>'Iota',74=>'theta1',75=>'Kappa',76=>'Lambda',77=>'Mu',78=>'Nu',79=>'Omicron',
80=>'Pi',81=>'Theta',82=>'Rho',83=>'Sigma',84=>'Tau',85=>'Upsilon',86=>'sigma1',87=>'Omega',
88=>'Xi',89=>'Psi',90=>'Zeta',91=>'bracketleft',92=>'therefore',93=>'bracketright',94=>'perpendicular',95=>'underscore',
96=>'radicalex',97=>'alpha',98=>'beta',99=>'chi',100=>'delta',101=>'epsilon',102=>'phi',103=>'gamma',
104=>'eta',105=>'iota',106=>'phi1',107=>'kappa',108=>'lambda',109=>'mu',110=>'nu',111=>'omicron',
112=>'pi',113=>'theta',114=>'rho',115=>'sigma',116=>'tau',117=>'upsilon',118=>'omega1',119=>'omega',
120=>'xi',121=>'psi',122=>'zeta',123=>'braceleft',124=>'bar',125=>'braceright',126=>'similar',127=>'.notdef',
128=>'.notdef',129=>'.notdef',130=>'.notdef',131=>'.notdef',132=>'.notdef',133=>'.notdef',134=>'.notdef',135=>'.notdef',
136=>'.notdef',137=>'.notdef',138=>'.notdef',139=>'.notdef',140=>'.notdef',141=>'.notdef',142=>'.notdef',143=>'.notdef',
144=>'.notdef',145=>'.notdef',146=>'.notdef',147=>'.notdef',148=>'.notdef',149=>'.notdef',150=>'.notdef',151=>'.notdef',
152=>'.notdef',153=>'.notdef',154=>'.notdef',155=>'.notdef',156=>'.notdef',157=>'.notdef',158=>'.notdef',159=>'.notdef',
160=>'Euro',161=>'Upsilon1',162=>'minute',163=>'lessequal',164=>'fraction',165=>'infinity',166=>'florin',167=>'club',
168=>'diamond',169=>'heart',170=>'spade',171=>'arrowboth',172=>'arrowleft',173=>'arrowup',174=>'arrowright',175=>'arrowdown',
176=>'degree',177=>'plusminus',178=>'second',179=>'greaterequal',180=>'multiply',181=>'proportional',182=>'partialdiff',183=>'bullet',
184=>'divide',185=>'notequal',186=>'equivalence',187=>'approxequal',188=>'ellipsis',189=>'arrowvertex',190=>'arrowhorizex',191=>'carriagereturn',
192=>'aleph',193=>'Ifraktur',194=>'Rfraktur',195=>'weierstrass',196=>'circlemultiply',197=>'circleplus',198=>'emptyset',199=>'intersection',
200=>'union',201=>'propersuperset',202=>'reflexsuperset',203=>'notsubset',204=>'propersubset',205=>'reflexsubset',206=>'element',207=>'notelement',
208=>'angle',209=>'gradient',210=>'registerserif',211=>'copyrightserif',212=>'trademarkserif',213=>'product',214=>'radical',215=>'dotmath',
216=>'logicalnot',217=>'logicaland',218=>'logicalor',219=>'arrowdblboth',220=>'arrowdblleft',221=>'arrowdblup',222=>'arrowdblright',223=>'arrowdbldown',
224=>'lozenge',225=>'angleleft',226=>'registersans',227=>'copyrightsans',228=>'trademarksans',229=>'summation',230=>'parenlefttp',231=>'parenleftex',
232=>'parenleftbt',233=>'bracketlefttp',234=>'bracketleftex',235=>'bracketleftbt',236=>'bracelefttp',237=>'braceleftmid',238=>'braceleftbt',239=>'braceex',
240=>'.notdef',241=>'angleright',242=>'integral',243=>'integraltp',244=>'integralex',245=>'integralbt',246=>'parenrighttp',247=>'parenrightex',
248=>'parenrightbt',249=>'bracketrighttp',250=>'bracketrightex',251=>'bracketrightbt',252=>'bracerighttp',253=>'bracerightmid',254=>'bracerightbt',255=>'.notdef',
1226=>'registered',1227=>'copyright',1228=>'trademark')

); // end of encoding maps

} // --- END OF CLASS ---

//============================================================+
// END OF FILE
//============================================================+
