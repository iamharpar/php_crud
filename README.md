# PHP Assignment

used software stack WAMP

## presumptions( or working conditions ):
* considering there exists a databse:
    #### articles
    * and a table under that database
        ##### articles_table
    * populated with fields:
        1. **id** with property: int, not null, primary key, auto increment
        2. **title** with property: not null, varchar(80)
        3. **summary** with property: not null, varchar(500)
        4. **status** with property: not null, varchar(40), default = "draft"
