$(document).ready(
    function (){
        setUpPage();
        getCourses(showCourses);
    }
)

function showCourses(courses){

    const html = courses.map(course => {

        const {id, thumb:{filename}, template:{course_model}} = course;
        let html =  `<div class="article-content">`;
        html+=`
                <a href="javascript:redirectClass(${id}, ${course_model})">    
                    <img  src="${filename}" class='img-fluid img_portrait'>
                </a>
                `;
        html += `</div>`;


        return html;

    });

    $('#articles').html(html);
    if(courses.length >= 12)
    {
        $('#articles').paginate({'perPage': 12,});
    }
   
    
}

function redirectLink(id,content_id,module_id,course_model){
  getVerifyUrl(id,function(response){
      if(response.status == 1)
      {
        $(location).attr('href', `content-${course_model}?course_id=${id}&id=${content_id}&module_id=${module_id}`);
      }else{
        $(location).attr('href',response.url);
      }

  });

}