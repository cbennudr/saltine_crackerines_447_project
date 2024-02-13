# Saltine Crackerines EECS 447 Project

## Description

Pokemon team builder that allows for filtering through pokemon by various attributes. 

#### Possible future features

* Fight simulator - build multiple teams and put them against each other
* Account system 

---

### Tables/Entities

**Player**
* id: int (key)
* name: string 
* team_color: string 

**Pokemon**
* poke_num: int (key)
* name: string
* type: string (multivalued)
* height: float
* weight: float
* cp: int

**Types**
* type_name: string (key)
* weak_againt: string (multivalued)
* strong_against: string (multivalued)

**Items**
* item_name: string (key)
* ability: string (multivalued)

### Relations

* Player \<has\> Pokemon
* Pokemon \<have\> Types
* Pokemon \<hold\> Items
* Items \<work_for\> Types
* Pokemon \<are_weak_to\> Types
* Pokemon \<are_strong_against\> Types

---

### Project Description and Requirements

Design and implement a database-supported online application.

* 3+ tables
* 5 different (dynamic) queries
* At least 2 queries with join
