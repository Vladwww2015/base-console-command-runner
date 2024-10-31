# This extension helps to run basic console command

### It works with few algorithms from box
#### 1) Run in shell background
#### 2) Run like console command

### It can to work separate depends on current mode(developer, production, default)


### 1) Add to yours di.xml
```xml
 <type name="IntegrationHelper\BaseConsoleCommandRunner\Model\ConsoleCommandRunner">
    <arguments>
        <argument name="processes" xsi:type="array">
            <item name="test" xsi:type="object">IntegrationHelper\Test\ConsoleCommandRunner\Test</item>
        </argument>
    </arguments>
</type>
```
### 2) IntegrationHelper\Test\ConsoleCommandRunner\Test must to implement one from interface:
1) \IntegrationHelper\BaseConsoleCommandRunner\Model\ConsoleCommandDefaultProcessInterface
OR 
2) \IntegrationHelper\BaseConsoleCommandRunner\Model\ConsoleCommandShellBackgroundProcessInterface

### 3) For work with mode you need to implement one(for example for testing) or all interfaces(global)
1) \IntegrationHelper\BaseConsoleCommandRunner\Model\EnableInDefaultMode
2) \IntegrationHelper\BaseConsoleCommandRunner\Model\EnableInDeveloperMode
3) \IntegrationHelper\BaseConsoleCommandRunner\Model\EnableInProductionMode
