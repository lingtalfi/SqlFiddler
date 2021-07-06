SqlFiddler, conception notes
================
2021-07-06


A tool to help when writing sql queries where the user can opt-in some parts.




Intro
--------
2021-07-06

While writing sql queries for a front end, I noticed that the queries I wrote had always 2 parts in it:

- a core part, which is the main part of the query
- a user part, which is some parts of the query that I allowed the user to modify


I also noticed that the user parts are generally confined to a few areas of the query:


- where (when the user is allowed to search)
- order by (when the user is allowed to sort)
- limit (when the user browses the pages, or/and when he is allowed to choose the number of items per page for instance)


Because of those observations, I decided to create the SqlFiddler helper, as to crystallize this idea into a structure,
making it easier for me to write front-end queries.


The benefits of using the fiddler are the following:

- the query is readable
- the user parts are controlled/protected by design



Example
-------
2021-07-06

Ok, enough talking, here is how it works (example from my code):


```php 

<?php 


    /**
     * @implementation
     */
    public function getProductListItems(array $options = []): array
    {
        
        $search = $options['search'] ?? null;
        $orderBy = $options['orderBy'] ?? null;
        $page = $options['page'] ?? null;


        $u = new SqlFiddlerUtil();
        

        $u
            ->setSearchExpression('(
          i.label like :search or 
          i.reference like :search 
          )', 'search')
            ->setOrderByMap([
                "_default" => 'i.front_importance desc',
                "newest" => 'i.post_datetime desc',
                "price_increasing" => 'i.price_in_euro asc',
                "price_decreasing" => 'i.price_in_euro desc',
                "avg_rating" => 'i.avg_rating desc',
            ])
        ;


        $markers = [];
        $sSearch = $u->getSearchExpression($search, $markers);
        $sOrderBy = $u->getOrderBy($orderBy);
        $iPage = $u->getPageOffset($page);



        $q = "
select i.id, i.label, i.reference, i.price_in_euro,
       group_concat(concat(t.rating, ':', t.nb_ratings) order by t.rating separator ', ') as nb_ratings,
       t2.avg_rating
from lks_item i
    
    
    
         inner join (
    select item_id,
           rating,
           count(*) as nb_ratings
    from lks_user_rates_item
    group by rating, item_id
) as t on i.id = t.item_id


         inner join (
    select item_id,
           avg(rating) as avg_rating
    from lks_user_rates_item
    group by item_id
) as t2 on i.id = t2.item_id


where 
      i.item_type = '1' and i.status = '1'
      and $sSearch

group by i.id
order by $sOrderBy
limit $iPage, 10

        ";

        return $this->pdoWrapper->fetchAll($q, $markers, \PDO::FETCH_ASSOC);
    }
```


In the above example, I allow the user to browse pages (obviously), to order by a few well-defined criteria, and
to search in the label and reference of the products.


The core query remains readable.


The second argument to the setSearchExpression method is the marker name. 
Using markers helps prevent sql injection.

The marker value is set with the call to the getSearchExpression method.



Notice that all user values are either defined, or set to null.

This is a convention used by the fiddler. It makes it easy to define the user parameters.




Recommendations
--------
2021-07-06


Here are a few recommendations when Working with the fiddler:

- always wrap your core query with double quotes, so that you can easily inject php variables in your query 
- always use pdo markers (if possible) in your search expression, to avoid sql injection  
