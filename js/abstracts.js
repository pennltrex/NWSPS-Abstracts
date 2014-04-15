/************************************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  Copyright (c) 2008 Omar Qazi
 *
 *  phpAbstracts is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  phpAbstracts is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with phpAbstracts.  If not, see <http://www.gnu.org/licenses/>. 
 *
************************************************************************/



function deleteconfirm(abstract_id)
{
 var check = confirm("Are you sure you wish to delete this abstract? This CANNOT be undone!");
 if (check == true)
   return true;
 else 
 	return false;
}



function deletereviewer(review_id, abstract_id)
{
 var check = confirm("Are you sure you wish to remove this reviewer?");
 if (check == true)
 {
   window.location="delete_reviewer.php?x=" + review_id + "&y=" + abstract_id;
 }
}



function validate(form) {
	
	if ( ( document.review_form.relevance[0].checked == false )
    && ( document.review_form.relevance[1].checked == false ) 
	&& ( document.review_form.relevance[2].checked == false ) 
	&& ( document.review_form.relevance[3].checked == false ) )
    {
        alert ( "Please select a Relevance rating" );
        return false;
    }
	
	if ( ( document.review_form.quality[0].checked == false )
    && ( document.review_form.quality[1].checked == false ) 
	&& ( document.review_form.quality[2].checked == false ) 
	&& ( document.review_form.quality[3].checked == false ) )
    {
        alert ( "Please select a Quality rating" );
        return false;
    }
	
	if ( ( document.review_form.recommendation[0].checked == false )
    && ( document.review_form.recommendation[1].checked == false ) 
	&& ( document.review_form.recommendation[2].checked == false ) 
	&& ( document.review_form.recommendation[3].checked == false ) )
    {
        alert ( "Please select a Recommendation" );
        return false;
    }
	
	if ( document.review_form.comments.value == "" )
    {
        alert ( "Please fill in the 'Comments' area" );
        return false;
    }

	document.getElementById('review_form_submit').disabled = "true";
	document.getElementById('review_form_submit').value = "Processing...";
	return true;
}



function show(elementid) {
	document.getElementById(elementid).style.visibility = "visible"; 
	document.getElementById(elementid).style.display = "block";
}



function hide(elementid) {
	document.getElementById(elementid).style.visibility = "hidden"; 
	document.getElementById(elementid).style.display = "none";
}



function tableruler()
{
 if (document.getElementById && document.createTextNode)
  {
   var tables=document.getElementsByTagName('table');
   for (var i=0;i<tables.length;i++)
   {
     var trs=tables[i].getElementsByTagName('tr');
     for(var j=0;j<trs.length;j++)
     {
      if(trs[j].parentNode.nodeName=='TBODY' && trs[j].parentNode.nodeName!='TFOOT')
       {
       trs[j].onmouseover=function(){this.className='ruled';return false}
       trs[j].onmouseout=function(){this.className='';return false}
     }
    }
  }
 }
}

