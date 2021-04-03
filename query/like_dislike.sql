select * From articles 
Left Join(
	select article_id , sum(liked) liked , sum(!liked) disliked from likes group by article_id
) likes on likes.`article_id` = articles.`id`