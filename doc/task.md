# Challenge

## Background

ProcurePro is a __procurement solution for commercial builders__. Imagine you're building a hotel, school or hospital -
you don't do all the work yourself. Instead, you will __engage many subcontractors__ to do the work for you (e.g.
earthworks, plumbers, electricians, etc).

In order to find the best subcontractor for the job, you run a __tender process__ and receive
a __number of different quotes__. Now you put these quotes into a "__trade comparison__" to help you compare each one.

Each subcontractor on a trade comparison will have a name and few pieces of financial information that you can use to
calculate their "__final cost__".

1. __Price__: the bottom line quote you receive
2. __Discount__: any discount that you are able to negotiate with the subcontractor (eg. "mates rates")
3. __Adjustment__: price adjustments you need to account for (e.g. changes to the design or materials, etc.)
4. __Unlet cost__: ancillary costs you are expecting to spend (e.g. items the subcontractor has excluded, contingencies,
   etc.)

Using these four financial figures, you can now calculate the "__final cost__":

```
final cost = price - discount + adjustment + unlet cost
```

Each of the properties on the Subcontractor begin as `null`, but once they are set they cannot be changed back to
`null`. This allows us to differentiate between `0` and `no value provided yet`.

## Tasks

In order to complete this challenge, we have provided you with the following:

- A single database entity, containing the properties specified above ([Subcontractor](/src/Entity/Subcontractor.php))
- A completed endpoint to create a
  subcontractor ([CreateSubcontractorController](/src/Controller/CreateSubcontractorController.php))
    - A simple example of how we
        - create and register a controller,
        - parse the request body into a type safe model; and
        - return a response to the user
- A completed functional test for the create subcontractor
  endpoint ([CreateSubcontractorTest](/tests/Functional/CreateSubcontractorTest.php))
    - An example of how we
        - make an HTTP request during a test; and
        - assert on the state of the database afterwards
- An endpoint and functional test for listing all subcontractors 
    ([ListSubcontractorsController](/src/Controller/ListSubcontractorsController.php))
  - Demonstration of:
    - how to load entities from the database; and
    - using response models
  - This endpoint currently returns a 500 `FinalCost` is not yet implemented
- A failing functional test for a missing patch subcontractor
  endpoint ([PatchSubcontractorTest](/tests/Functional/PatchSubcontractorTest.php))
    - Showing how to load database fixtures in a test
- An empty core function for calculating the final cost ([FinalCost](/src/Core/FinalCost.php))
    - You'll need to implement this function
- A failing unit test for the FinalCost core function ([FinalCostTest](/tests/Unit/FinalCostTest.php))
    - Showing how to create a unit test

There are two tasks for you to complete:

### 1. Implement the `App\Core\FinalCost` core function

As detailed above, the __final cost__ is calculated with:

```
final cost = price - discount + adjustment + unlet cost
```

This calculation is simpler than it appears since each property is nullable. Be sure to write solid tests for this one,
you would hate someone to come along in a few months, change a `+` to a `-` and break the entire application 😱.

Once this is complete, the `ListSubcontractors` endpoint should work successfully.

### 2. Create an endpoint to PATCH a Subcontractor

Create a controller for a `PATCH /subcontractors/{id}` endpoint. It should take a subcontractor id as a path parameter,
and take the following request body as JSON where every property is __optional__ (i.e. a client should be able
to `PATCH` any individual property or combination of properties):

```
{
  name: string
  price: integer
  discount: integer
  adjustment: integer
  unletCost: integer
}
```

Note that:

- you already have one failing test for this endpoint (but more may be required)
- once a property on a Subcontractor has been set once, it should not be possible to set it back to `null`
