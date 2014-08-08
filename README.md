PHP common data gateway
=======================

There is a way described here of how to organize common data to be available throughout a program. Common data (also called Global data) in this context are the functions and variables (or methods and properties) accessed during one server request. Permanent data saved between sessions are not covered here.  In larger projects, it becomes more important how to manage common data to be easily reachable in any part of the program.

How it works
------------

All the common accessing is collected into one point. Thru this point - a gateway - all the global usings can be controlled and observed. The common gateway is realized by two classes: the gateway itself, containing some static properties and methods, and the common data class, holding common methods and properties. Common methods are called from the gateway via *__callStatic()* magic method. Common properties are accessed via property path methods. Common work area is supplied also for temporary and/or time-critical data. The methods does not check for errors - it's presumed to be an error handling responsibility.

Since the gateway can be referred many times in the program then the names concerning a gateway are selected to be short.

- The 'Â¤' as well-distinguishable is used for a gateway classname and '_' to access common properties. 
- The gateway is activated by *Â¤::_Init()* method (see *example.php*). 
- The common methods are called simply using the Â¤:: prefix, for example: *Â¤::Startup(), Â¤::Convert($txt)* etc. 
- The properties are accessed via *Â¤::_()* method having 1st argument as a property path string. 
- The path separator is '.' by default and can be changed. 
- If 2nd argument is missing, a property value is gotten, for example *Â¤::_('addr.street')*. 
- Otherwise new value is assigned to a property, for example *Â¤::_('addr.street','Elm')*. 
- The property path elements must be property names (not associative array keys).
- Only path's terminal value can be overloaded by *get/set* magic methods; 
- The workarea is accessible via *Â¤::$_*  public property.

**Note.** A more rough way would be to implement all the common properties via *Â¤::$_* but it makes properties vulnerable for occasional overwritings.

How it fits OOP
---------------

Common/Global state is unavoidable when you work with any information, we should not disregard it, but instead we need to decide how to work with it. PHP core functions must be extended by customer ones to perform standard/elemantary actions. Collecting them into one class/object instead of scattering into many classes achieves more comprehensiveness. Certain data (database link, text arrays, configurations etc.), once retrieved or initialized, need to be easily reachable in any part of the project code. Making them centrally accessible releases from a pain to pass frequently-used variables continuously throughout several objects/methods/functions. 

The design patterns like DI container, Service Locator, Singletone all allow the same thing - make some data centrally available. The gateway approach is a solution following OOP paradigm as far as possible. Developer is responsible for decision - what is a subject to class or common method/property. The gateway class can be complemented with several functionality to have more control over common data.

The package
-----------

The following files are included:

1. *gateway.php* - the gateway class; requires PHP 5.3+;
2. *common.php* - the common data class skeleton; contains necessary methods and properties for the gateway class, and some data for the example;
3. *example.php* - demonstrates the common gateway functionality.

The common data gateway is implemented in vRegistry solution (see [vregistry.com]).

  [vregistry.com]: http://vregistry.com/hlp/en
